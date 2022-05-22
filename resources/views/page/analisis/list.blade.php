    <!--begin::Table-->
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_literatur">
        <!--begin::Table head-->
        <thead>
            <!--begin::Table row-->
            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                {{-- <th class="w-10px pe-2">
                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                    </div>
                </th> --}}
                <th class="min-w-125px">Judul</th>
                <th class="min-w-125px">Deskripsi</th>
                <th class="min-w-125px">ID User</th>
                <th class="min-w-125px">Status</th>
                <th class="min-w-125px">Created at</th>
                <th class="min-w-125px">Actions</th>
            </tr>
            <!--end::Table row-->
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        <tbody class="text-gray-600 fw-bold">
            <!--begin::Table row-->
            @foreach($analisisdata as $item)
            <tr>
                <!--begin::Checkbox-->
                {{-- <td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="1" />
                    </div>
                </td> --}}
                <!--end::Checkbox-->
                <!--begin::User=-->
                <td class="d-flex align-items-center">
                    <!--begin:: Avatar -->
                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="storage/{{$item->file}}">
                            <div class="symbol-label">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                        </a>
                    </div>
                    <!--end::Avatar-->
                    <!--begin::User details-->
                    <div class="d-flex flex-column">
                        <a href="storage/{{$item->file}}" class="text-gray-800 text-hover-primary mb-1">{{$item->judul}}</a>
                    </div>
                    <!--begin::User details-->
                </td>
                <!--end::User=-->
                <!--begin::Role=-->
                <td>{{$item->deskripsi}}</td>
                <td>{{$item->id_user}}</td>
                <!--end::Role=-->
                <!--begin::Last login=-->
                <td>
                    @if($item->status == 'Dipesan')
                    <span class="badge badge-light-warning">{{$item->status}}</span>
                    @elseif($item->status == 'Diterima')
                    <span class="badge badge-light-primary">{{$item->status}}</span>
                    @elseif($item->status == 'Selesai')
                    <span class="badge badge-light-success">{{$item->status}}</span>
                    @else
                    <span class="badge badge-light-danger">{{$item->status}}</span>
                    @endif
                    {{-- <div class="badge badge-light fw-bolder">{{$item->status}}</div> --}}
                </td>
                <!--end::Last login=-->
                <!--begin::Joined-->
                <td>{{$item->created_at}}</td>
                <!--begin::Joined-->
                <!--begin::Action=-->
                <td>
                    <form method="POST" action="{{ route('analisisdata.update', $item->id) }}">
                        @csrf
                        <select class="form-select form-select-sm" name="status"
                            onchange='if(this.value != 0) { this.form.submit(); }'>
                            <option value='0' disabled selected>Status</option>
                            <option value='Dipesan'>Dipesan</option>
                            <option value='Diterima'>Diterima</option>
                            <option value='Selesai'>Selesai</option>
                            <option value='Ditolak'>Ditolak</option>
                        </select>
                    </form>
                </td>
                <!--end::Action=-->
            </tr>
            @endforeach
            <!--end::Table row-->
        </tbody>
        <!--end::Table body-->
    </table>
    <!--end::Table-->
{{$analisisdata->links()}}
