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
                <th class="min-w-125px">Penulis</th>
                <th class="min-w-125px">Tahun Terbit</th>
                <th class="min-w-125px">Tag</th>
                <th class="min-w-125px">Created at</th>
                <th class="min-w-125px">Actions</th>
            </tr>
            <!--end::Table row-->
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        <tbody class="text-gray-600 fw-bold">
            <!--begin::Table row-->
            @foreach($literatur as $item)
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
                        <a href="{{ $item->file }}">
                            <div class="symbol-label">
                                <i class="bi bi-file-pdf"></i>
                            </div>
                        </a>
                    </div>
                    <!--end::Avatar-->
                    <!--begin::User details-->
                    <div class="d-flex flex-column">
                        <a href="{{$item->file}}" class="text-gray-800 text-hover-primary mb-1">{{$item->judul}}</a>
                    </div>
                    <!--begin::User details-->
                </td>
                <!--end::User=-->
                <!--begin::Role=-->
                <td>{{$item->penulis}}</td>
                <td>{{$item->tahun_terbit}}</td>
                <!--end::Role=-->
                <!--begin::Last login=-->
                <td>
                    <div class="badge badge-light fw-bolder">{{$item->tag}}</div>
                </td>
                <!--end::Last login=-->
                <!--begin::Joined-->
                <td>{{$item->created_at}}</td>
                <!--begin::Joined-->
                <!--begin::Action=-->
                <td class="text">
                    <div class="btn-group" role="group">
                        <button id="aksi" type="button" class="btn btn-sm btn-light btn-active-light-primary" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                            <span class="svg-icon svg-icon-5 m-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                </svg>
                            </span>
                        </button>
                        <div class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" aria-labelledby="aksi">
                            <div class="menu-item px-3">
                                <a href="javascript:;" onclick="handle_open_modal('{{route('literatur.edit',$item->id)}}','#ModalCreateLiteratur','#contentLiteraturModal');" class="menu-link px-3">Edit</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="javascript:;" onclick="handle_confirm('Apakah Anda Yakin?','Yakin','Tidak','DELETE','{{route('literatur.destroy',$item->id)}}');" class="menu-link px-3">Delete</a>
                            </div>
                        </div>
                    </div>
                </td>
                <!--end::Action=-->
            </tr>
            @endforeach
            <!--end::Table row-->
        </tbody>
        <!--end::Table body-->
    </table>
    <!--end::Table-->
{{$literatur->links()}}
