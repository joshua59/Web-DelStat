<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h6>
                        {{-- @if ($data->id) --}}
                            Ubah
                        @else
                            Tambah
                        @endif
                        data Spanduk
                    </h6>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end">
                        {{-- <button type="button" onclick="load_list(1);" class="btn btn-sm btn-primary">Kembali</button> --}}
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <form id="form_input">
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="required fs-6 fw-bold mb-2">URL</label>
                            {{-- <input type="text" class="form-control" name="url" placeholder="Masukkan URL..." value="{{$data->url}}"> --}}
                        </div>
                        <div class="col-lg-6">
                            <label class="fs-6 fw-bold mb-2">Foto</label>
                            {{-- <input type="file" class="form-control" name="photo" placeholder="Foto...." value="{{$data->photo}}"> --}}
                        </div>
                        <div class="min-w-150px mt-10 text-end">
                            {{-- @if ($data->id) --}}
                            {{-- <button id="tombol_simpan" onclick="handle_upload('#tombol_simpan','#form_input','{{route('office.banner.update',$data->id)}}','PATCH');" class="btn btn-sm btn-primary">Simpan</button> --}}
                            @else
                            {{-- <button id="tombol_simpan" onclick="handle_upload('#tombol_simpan','#form_input','{{route('office.banner.store')}}','POST');" class="btn btn-sm btn-primary">Simpan</button> --}}
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>