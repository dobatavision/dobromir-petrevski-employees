@extends('layout')

@section('content')
<title>Dobromir Petrevski employees</title>
<h1> Dobromir Petrevski employees</h1>
<h2> Upload CSV:
    <form method="POST" action="{{route('upload')}}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept=".csv" required>
        <button class="rounded-md bg-green-600 py-2 px-4 border border-transparent text-center text-m text-white transition-all shadow-md hover:shadow-lg focus:bg-green-700 focus:shadow-none active:bg-green-700 hover:bg-green-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2" type="submit"
        >Upload</button>
    </form>
</h2>
<div class="relative flex flex-col w-full h-full text-slate-300 bg-slate-800 shadow-md rounded-lg bg-clip-border"> Output: @if(empty($result))
              @else
              <table class="w-full text-left table-auto min-w-max">
                <thead>
                    <tr>
                        <th class="p-4 border-b border-slate-600 bg-slate-700">Employee ID #1</th>
                        <th class="p-4 border-b border-slate-600 bg-slate-700">Employee ID #2</th>
                        <th class="p-4 border-b border-slate-600 bg-slate-700">Project ID</th>
                        <th class="p-4 border-b border-slate-600 bg-slate-700">Days worked</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($result as $item)
                        <tr class="hover:bg-slate-700">
                            <td class="p-4 border-b border-slate-700">{{ $item['Employee ID #1'] }}</td>
                            <td class="p-4 border-b border-slate-700">{{ $item['Employee ID #2'] }}</td>
                            <td class="p-4 border-b border-slate-700">{{ $item['Project ID'] }}</td>
                            <td class="p-4 border-b border-slate-700">{{ $item['Days worked'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
              @endif
</div>
@endsection
