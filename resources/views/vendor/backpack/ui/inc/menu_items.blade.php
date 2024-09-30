{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Scripts" icon="la la-question" :link="backpack_url('script')" />
<x-backpack::menu-item title="Patients" icon="la la-question" :link="backpack_url('patient')" />
{{--<x-backpack::menu-item title="Medical consultations" icon="la la-question" :link="backpack_url('medical-consultation')" />--}}
{{--<x-backpack::menu-item title="Treatment details" icon="la la-question" :link="backpack_url('treatment-detail')" />--}}
<x-backpack::menu-item title="Medicine categories" icon="la la-question" :link="backpack_url('medicine-category')" />
{{--<x-backpack::menu-item title="Medicare card details" icon="la la-question" :link="backpack_url('medicare-card-details')" />--}}
{{--<x-backpack::menu-item title="Clinics" icon="la la-question" :link="backpack_url('clinics')" />--}}
{{--<x-backpack::menu-item title="Clinics" icon="la la-question" :link="backpack_url('clinic')" />--}}
<x-backpack::menu-item title="Nurses" icon="la la-question" :link="backpack_url('nurse')" />
<x-backpack::menu-item title="Doctor Approval" icon="la la-patient" :link="route('doctor-approval')" />

<x-backpack::menu-item title="Locations" icon="la la-question" :link="backpack_url('locations')" />


<x-backpack::menu-dropdown title="Products" icon="la la-question" :link="backpack_url('product')" >
    <x-backpack::menu-item title="Areas" icon="la la-question" :link="backpack_url('area')" />
</x-backpack::menu-dropdown>
