<template>
    <div class="container">
        <h1 class="text-center">Laravel Video Chat</h1>
        <div class="video-container">
            <video ref="video-here" muted autoplay class="cursor-pointer user-video"></video>
            <video ref="video-there" autoplay class="cursor-pointer partner-video"></video>
        </div>

        <!-- Buttons for calling other users -->
        <div class="row mt-5">
            <div class="col">
                <div class="btn-group" role="group">
                    <button
                        type="button"
                        class="btn btn-primary mr-2"
                        v-for="user in allusers"
                        :key="user.id"
                        @click="placeVideoCall(user.id, user.name)"
                    >
                        Call {{ user.name }}
                        <span class="badge badge-light">{{ getUserOnlineStatus(user.id) }}</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Incoming Call Prompt -->
        <div class="row" v-if="incomingCallDialog">
            <div class="col">
                <p>Incoming Call From <strong>{{ callerDetails.name }}</strong></p>
                <div class="btn-group" role="group">
                    <button
                        type="button"
                        class="btn btn-danger"
                        @click="declineCall"
                    >
                        Decline
                    </button>
                    <button
                        type="button"
                        class="btn btn-success ml-5"
                        @click="acceptCall"
                    >
                        Accept
                    </button>
                </div>
            </div>
        </div>

        <!-- Call Action Buttons -->
        <div class="action-btns" v-if="callPlaced">
            <button type="button" class="btn btn-info" @click="toggleMuteAudio">
                {{ mutedAudio ? "Unmute" : "Mute" }}
            </button>
            <button type="button" class="btn btn-primary mx-4" @click="toggleMuteVideo">
                {{ mutedVideo ? "Show Video" : "Hide Video" }}
            </button>
            <button type="button" class="btn btn-danger" @click="endCall">
                End Call
            </button>
        </div>
    </div>
</template>
<script>
import Peer from "simple-peer";
import Pusher from "pusher-js";
import { getPermissions } from "../helpers";

export default {
    props: ['allusers', 'authuserid', 'pusherKey', 'pusherCluster'],
    data() {
        return {
            stream: null,
            callPlaced: false,
            callPartner: null,
            mutedAudio: false,
            mutedVideo: false,
            incomingCallDialog: false,
            callerDetails: null,
            peer: null,
            channel: null,
        };
    },
    mounted() {
        this.setupPusher();
    },
    methods: {
        setupPusher() {
            const pusher = new Pusher(this.pusherKey, {
                authEndpoint: '/admin/auth/video-chat-new',
                cluster: this.pusherCluster,
                auth: {
                    headers: {
                        'X-CSRF-Token': document.head.querySelector('meta[name="csrf-token"]').content
                    }
                }
            });

            this.channel = pusher.subscribe('presence-video-chat');
            this.channel.bind(`client-signal-${this.authuserid}`, (signal) => {
                this.incomingCall(signal);
            });
        },
        async getMediaPermission() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
                this.$refs['video-here'].srcObject = stream;
                this.stream = stream;
            } catch (error) {
                console.error('Error accessing media devices', error);
            }
        },
        placeVideoCall(id, name) {
            this.callPartner = name;
            this.callPlaced = true;
            this.startVideoChat(id, true);
        },
        startVideoChat(userId, initiator) {
            this.getMediaPermission().then(() => {
                this.peer = new Peer({
                    initiator: initiator,
                    stream: this.stream,
                    trickle: false
                });

                this.peer.on('signal', (data) => {
                    this.channel.trigger(`client-signal-${userId}`, {
                        userId: this.authuserid,
                        data: data
                    });
                });

                this.peer.on('stream', (stream) => {
                    this.$refs['video-there'].srcObject = stream;
                });

                this.peer.on('close', () => {
                    this.endCall();
                });
            });
        },
        incomingCall(signal) {
            this.incomingCallDialog = true;
            this.callerDetails = {
                id: signal.userId,
                name: this.allusers.find(user => user.id === signal.userId).name
            };
            this.peer.signal(signal.data);
        },
        acceptCall() {
            this.callPlaced = true;
            this.incomingCallDialog = false;
            this.startVideoChat(this.callerDetails.id, false);
        },
        declineCall() {
            this.incomingCallDialog = false;
            this.peer.destroy();
        },
        toggleMuteAudio() {
            const audioTrack = this.stream.getAudioTracks()[0];
            audioTrack.enabled = !audioTrack.enabled;
            this.mutedAudio = !this.mutedAudio;
        },
        toggleMuteVideo() {
            const videoTrack = this.stream.getVideoTracks()[0];
            videoTrack.enabled = !videoTrack.enabled;
            this.mutedVideo = !this.mutedVideo;
        },
        endCall() {
            if (this.peer) this.peer.destroy();
            this.callPlaced = false;
        },
        getUserOnlineStatus(id) {
            const onlineUserIndex = this.allusers.findIndex(user => user.id === id);
            return onlineUserIndex >= 0 ? "Online" : "Offline";
        }
    }
};

</script>
