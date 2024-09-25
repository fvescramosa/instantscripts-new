// server.js

const express = require('express');
const http = require('http');
const socketIo = require('socket.io');

// Set up an Express server
const app = express();
const server = http.createServer(app);

// Set up Socket.io for signaling
const io = socketIo(server, {
    cors: {
        origin: '*',
        methods: ['GET', 'POST'],
    },
});

// Handle signaling
io.on('connection', (socket) => {
    console.log('User connected:', socket.id);

    socket.on('join-room', (room) => {
        socket.join(room);
        socket.broadcast.to(room).emit('user-joined', socket.id);
    });

    socket.on('signal', (data) => {
        io.to(data.to).emit('signal', {
            from: data.from,
            signal: data.signal,
        });
    });

    socket.on('disconnect', () => {
        console.log('User disconnected:', socket.id);
    });
});

// Start the server
server.listen(3000, () => {
    console.log('Socket.io server running on port 3000');
});
