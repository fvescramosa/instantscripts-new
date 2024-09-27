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

                                            <p><strong>Quantity:</strong> {{ $script->treatment_detail()->quantity }}</p>
                                            <p><strong>Location:</strong> {{ implode(', ', $script->treatment_detail()->location) }}</p>
                                            <p><strong>Location:</strong> {{ implode(', ', $script->treatment_detail()->location) }}</p>

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
