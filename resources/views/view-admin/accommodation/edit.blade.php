<!-- resources/views/view-admin/edit.blade.php -->
<x-admin>
    <div class="head-title">
        <div class="left">
            <h1>Edit Tempat Inap</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Edit Tempat Inap</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container">
        <x-admin.form action="{{ route('admin.accommodations.update', $accommodation->id) }}" method="PUT" :accommodation="$accommodation" />
    </div>
</x-admin>
