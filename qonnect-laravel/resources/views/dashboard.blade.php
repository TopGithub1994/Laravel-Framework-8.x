<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- {{ __('Dashboard') }} -->
            Hello , {{Auth::user()->name}}

            <b class="float-end">User Count : {{count($users)}}</b> 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Session</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i=1)
                        @foreach($users as $row)
                        <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{$row->name}}</td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->created_at}}</td>
                        <td>{{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>