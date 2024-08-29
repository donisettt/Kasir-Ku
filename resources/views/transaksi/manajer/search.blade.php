<form action="" method="get" class="form-inline">
    <select name="tanggal" class="form-control form-control-sm mr-2">
        <option value="">Tanggal :</option>
        @for ($i=1; $i<=31; $i++) @if (request()->tanggal == $i)
            <option value="{{ $i }}" selected>{{ $i }}</option>
            @else
            <option value="{{ $i }}">{{ $i }}</option>
            @endif
            @endfor
    </select>
    <select name="bulan" class="form-control form-control-sm mr-2">
        <option value="">Bulan :</option>
        @php
        $bulan = [
        ['1','Januari'],
        ['2','Februari'],
        ['3','Maret'],
        ['4','April'],
        ['5','Meni'],
        ['6','Juni'],
        ['7','Juli'],
        ['8','Agustus'],
        ['9','September'],
        ['10','Oktober'],
        ['11','November'],
        ['12','Desember'],
        ]
        @endphp
        @foreach ( $bulan as $row )
        @if (request()->bulan == $row[0])
        <option value="{{ $row[0] }}" selected>{{ $row[1] }}</option>
        @else
        <option value="{{ $row[0] }}">{{ $row[1] }}</option>
        @endif
        @endforeach
    </select>
    <select name="tahun" class="form-control form-control-sm mr-2">
        <option value="">Tahun :</option>
        @for ($i=date('Y'); $i>=(date('Y')-10); $i--)
        @if (request()->tahun == $i)
        <option value="{{ $i }}" selected>{{ $i }}</option>
        @else
        <option value="{{ $i }}">{{ $i }}</option>
        @endif
        @endfor
    </select>
    <input name="nama" type="text" class="form-control form-control-sm mr-2" placeholder="Nama Kasir"
        value="<?= request()->nama ?>" />
    <button type="submit" class="btn btn-sm btn-primary">
        <i class="fas fa-search"></i>
    </button>
</form>