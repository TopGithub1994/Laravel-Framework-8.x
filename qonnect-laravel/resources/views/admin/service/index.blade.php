<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
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
                        <div class="card-header">ตารางข้อมูลบริการ</div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Image</th>
                                <th scope="col">Service Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                                @foreach($services as $row)
                                <tr>
                                <th scope="row">{{$services->firstItem()+$loop->index}}</th>
                                <td>
                                    <img src="{{asset($row->service_image)}}" alt="" width="50rem" height="50rem">
                                </td>
                                <td>{{$row->service_name}}</td>
                                <!-- <td>{{$row->service_image}}</td> -->
                                <td>
                                    @if($row->created_at == NULL)
                                        No Data
                                    @else
                                    {{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('/service/edit/'.$row->id)}}" class="btn btn-primary">edit</a>
                                </td>
                                <td>
                                    <a href="{{url('/service/destroy/'.$row->id)}}" class="btn btn-warning"
                                    onclick="return confirm('คุณต้องการลบข้อมูลใช่ไหม ?')"
                                    >delete</a>
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$services->links()}}           
                    </div>
                </div>
                    <div class="col-md-4">
                        <div class="card">
                        <div class="card-header">แบบฟอร์มบริการ</div>
                            <div class="card-body">
                                <form action="{{route('addService')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="service_name">ชื่อบริการ</label>
                                        <input type="text" class="form-control" name="service_name" id="service_name">
                                    </div>
                                    @error('service_name')
                                        <div class="my-2">
                                            <span class="text-danger">{{$message}}</span>
                                        </div>
                                    @enderror
                                    <div class="form-group">
                                        <label for="service_image">ภาพประกอบ</label>
                                        <input type="file" class="form-control" name="service_image" id="service_image">
                                    </div>
                                    @error('service_image')
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