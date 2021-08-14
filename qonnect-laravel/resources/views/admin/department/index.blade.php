<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- {{ __('Dashboard') }} -->
            Hello , {{Auth::user()->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if(session("success"))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">ตารางข้อมูลแผนก</div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Department</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                                @foreach($departments as $row)
                                <tr>
                                <th scope="row">{{$departments->firstItem()+$loop->index}}</th>
                                <td>{{$row->department_name}}</td>
                                <td>{{$row->user->name}}</td>
                                <td>
                                    @if($row->created_at == NULL)
                                        No Data
                                    @else
                                    {{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('/department/edit/'.$row->id)}}" class="btn btn-primary">edit</a>
                                </td>
                                <td>
                                    <a href="{{url('/department/softdelete/'.$row->id)}}" class="btn btn-warning">delete</a>
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$departments->links()}}           
                    </div>
                    @if(count($trashDepartments)>0)
                    <div class="card my-2">
                    <div class="card-header">Recycle</div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Department</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Restore</th>
                                <th scope="col">Destroy</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                                @foreach($trashDepartments as $row)
                                <tr>
                                <th scope="row">{{$trashDepartments->firstItem()+$loop->index}}</th>
                                <td>{{$row->department_name}}</td>
                                <td>{{$row->user->name}}</td>
                                <td>
                                    @if($row->created_at == NULL)
                                        No Data
                                    @else
                                    {{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('/department/restore/'.$row->id)}}" class="btn btn-primary">restore</a>
                                </td>
                                <td>
                                    <a href="{{url('/department/destroy/'.$row->id)}}" class="btn btn-danger">destroy</a>
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$trashDepartments->links()}}
                    </div>
                    @endif
                </div>
                <div class="col-md-4">
                <div class="card">
                <div class="card-header">แบบฟอร์ม</div>
                    <div class="card-body">
                        <form action="{{route('addDepartment')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="department_name">ชื่อแผนก</label>
                                <input type="text" class="form-control" name="department_name" id="department_name">
                            </div>
                            @error('department_name')
                                <div class="my-2">
                                    <span class="text-danger">{{$message}}</span>
                                </div>
                            @enderror
                            <br>
                            <input type="submit" value="บันทึก" class="btn btn-primary">
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>