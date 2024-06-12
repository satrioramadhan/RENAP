<!-- resources/views/view-admin/create.blade.php -->
<x-admin>
    <div class="head-title">
        <div class="left">
            <h1>Tambah Tempat Inap</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Tambah Tempat Inap</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container">
        <x-admin.form action="{{ route('admin.accommodations.store') }}" />
    </div>
</x-admin>
