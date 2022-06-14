    <!--begin::Table-->
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
        <!--begin::Table head-->
        <thead>
            <!--begin::Table row-->
            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                {{-- <th class="w-10px pe-2">
                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                    </div>
                </th> --}}
                <th class="min-w-125px">Nama user</th>
                <th class="min-w-125px">ID Kuis</th>
                <th class="min-w-125px">Nilai Kuis</th>
                <th class="min-w-125px">Created at</th>
            </tr>
            <!--end::Table row-->
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        <tbody class="text-gray-600 fw-bold">
            <!--begin::Table row-->
            @foreach($hasilkuis as $item)
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
                    <!--end::Avatar-->
                    <!--begin::User details-->
                    <div class="d-flex flex-column">
                        <a href="" class="text-gray-800 text-hover-primary mb-1">{{$item->nama_user}}</a>
                    </div>
                    <!--begin::User details-->
                </td>
                <!--end::User=-->
                <!--begin::Role=-->
                <td>{{$item->id_kuis}}</td>
                <td>{{$item->nilai_kuis}}</td>
                <!--end::Role=-->
                <!--begin::Last login=-->
                <!--end::Last login=-->
                <!--begin::Joined-->
                <td>{{$item->created_at}}</td>
                <!--begin::Joined-->
                <!--begin::Action=-->

                <!--end::Action=-->
            </tr>
            @endforeach
            <!--end::Table row-->
        </tbody>
        <!--end::Table body-->
    </table>
    <!--end::Table-->
{{$hasilkuis->links()}}
