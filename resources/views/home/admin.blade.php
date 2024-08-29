<x-content>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Admin</h5>
                </div>
                <div class="card-body">
                    @php
                    $user = Auth::user();
                    @endphp
                    <p>Nama Lengkap : {{ $user->nama }}</p>
                    <p>Username : {{ $user->username }}</p>
                </div>
            </div>
        </div>
    </div>
</x-content>