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
                                <div class="card">

                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Full Name</th>
                                                <th>Medicine Category</th>
                                                <th>Quantity</th>
                                                <th>Location</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @if($scripts)
                                                        @foreach($scripts as $script)
                                                         <tr>
                                                             <td>{{ $script->patient->full_name }}</td>
                                                             <td>{{ $script->medicine_category()->category ?? '' }}</td>
                                                             <td>{{ $script->treatment_detail->quantity }}</td>
                                                             <td>{{ implode(', ', $script->treatment_detail->location) }}</td>
                                                             <td>{{ ($script->approved ? 'Yes' : 'No')}}</td>

                                                             <td><a href="{{ route('doctor-approval.view',['id' => $script->id ]) }}">View</a></td>
                                                         </tr>
                                                        @endforeach
                                                @endif
                                            </tbody>
                                        </table>
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
