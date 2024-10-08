@extends(backpack_view('blank'))
@section('header')
    <section class="container-fluid d-print-none">
        <a href="javascript: window.print();" class="btn float-right"><i class="la la-print"></i></a>
        <h2>
            Records
        </h2>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Default box -->
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="container mt-5">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h6>Patient Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Patient Photo -->
                                    <div class="col-md-3 text-center">

                                    </div>
                                    <!-- Patient Data -->
                                    <div class="col-md-9">
                                        <h3>{{ $script->patient->full_name }}</h3>
                                        <p><strong>Age:</strong> {{ $script->age_at_consultation   }}</p>
                                        <p><strong>Gender:</strong> {{ $script->patient->gender }}</p>
                                        <p><strong>Contact:</strong> {{ $script->patient->mobile_number }}</p>
                                        <p><strong>Consultation Date:</strong> {{ $script->medical_consultation->consultation_date }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="container mt-5">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h6>Treatment Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Patient Photo -->

                                    <!-- Patient Data -->
                                    <div class="col-md-12">

                                            <p><strong>Quantity:</strong> {{ $script->treatment_detail->quantity }}</p>
                                            <p><strong>Location:</strong> {{ $script->treatment_detail->location }}</p>
                                            <p><strong>Extra Notes:</strong> {{  $script->treatment_detail->notes }}</p>
                                            <p><strong>Patient Consent to Photographs:</strong> {{ ( $script->treatment_detail->consent_to_photographs ? 'Yes' : 'No')  }}</p>
                                            <p><strong>Patient Consent to Treatment:</strong> {{ ( $script->treatment_detail->consent_to_treatment ? 'Yes' : 'No')  }}</p>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="container mt-5">
                        <div class="card treatment-photos">
                            <div class="card-header bg-primary text-white">
                                <h6>Treatment Photos</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Patient Photo -->

                                    <!-- Patient Data -->
                                    <div class="col-md-4">
                                        <img src="{{ $script->treatment_detail->left_treatment_photos }}" alt="">
                                    </div>
                                    <div class="col-md-4">
                                        <img src="{{ $script->treatment_detail->right_treatment_photos }}" alt="">
                                    </div>

                                    <div class="col-md-4">
                                        <img src="{{ $script->treatment_detail->top_treatment_photos }}" alt="">
                                    </div>

                                    <div class="col-md-4">
                                        <img src="{{ $script->treatment_detail->bottom_treatment_photos }}" alt="">
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="container mt-5">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h6>Medical Consultation</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Patient Photo -->

                                    <!-- Patient Data -->
                                    <div class="col-md-12">
                                        <table class="table table-striped">
                                            @foreach($medical_consultation_fields as $field)
                                                <tr>
                                                    <td>{{ $field['label'] }}</td>
                                                    <td>{{ ($script->medical_consultation[$field['name']] ? 'Yes' : 'No')}}</td>
                                                </tr>

                                            @endforeach
                                        </table>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="container mt-5">
                            @if($script->approved == 1)
                                <a class="btn btn-outline-danger  " href="{{ route('generate.pdf', ['id' => $script->id] ) }}"><span class="la la-file-pdf"></span> Generate Script</a>

                            @else
                                <a class="btn btn-success text-white" href="{{ route('script.approval', ['id' => $script->id]) }}"><span class="la la-check"></span> Approved</a>
                                <a class="btn btn-danger text-white" href="{{ route('script.reject', ['id' => $script->id]) }}"><span class="la la-times"></span> Reject</a>
                            @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('after_styles')
    <link rel="stylesheet"
          href="{{ asset('packages/backpack/crud/css/crud.css') . '?v=' . config('backpack.base.cachebusting_string') }}">
@endsection

@section('after_scripts')
    <script src="{{ asset('packages/backpack/crud/js/crud.js') . '?v=' . config('backpack.base.cachebusting_string') }}">
    </script>
@endsection
