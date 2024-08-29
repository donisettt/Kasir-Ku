<x-content>
    <div class="row">
        @php
        $data = \App\Models\Menu::select('id')->get()->count('id');
        @endphp
        <x-box :data-box="[
            'label'=>'Menu',
            'icon'=>'fas fa-utensils',
            'background'=>'bg-success',
            'value'=>$data,
            'href'=>route('menu.index')
            ]" />
        @php
        $data = \App\Models\Transaksi::select('id')->get()->count('id');
        @endphp
        <x-box :data-box="[
            'label'=>'Transaksi',
            'icon'=>'fas fa-cash-register',
            'background'=>'bg-info',
            'value'=>$data,
            'href'=>route('transaksi.index')
            ]" />
    </div>
    <div class="card">
        <div class="card-body">
            <div class="chart">
                <canvas id="chartTransaksi"></canvas>
            </div>
        </div>
    </div>
</x-content>
@php
$data = \App\Models\Transaksi::select(DB::raw('DATE(created_at) AS tanggal'),
DB::raw('sum(total) as jumlah'),
) ->
groupBy('tanggal') ->
get();
$label = [];
$jumlah = [];
foreach($data as $row) {
$label[] = date('d/m/y', strtotime($row -> tanggal));
$jumlah[] = $row -> jumlah;
}
@endphp
@push('js')
<script src="{{asset('adminlte/plugins/chart.js/Chart.min.js')}}"></script>
<script>
var ctx = document.getElementById('chartTransaksi').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode($label) ?>,
        datasets: [{
            label: "Pendapatan",
            data: <?= json_encode($jumlah) ?>,
        }]
    },
});
</script>
@endpush