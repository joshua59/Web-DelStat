<!--begin::Modal header-->
<div class="modal-header pb-0 border-0 justify-content-end">
    <!--begin::Close-->
    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
        <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
        <span class="svg-icon svg-icon-1">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                 height="24px" viewBox="0 0 24 24" version="1.1">
                <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                   fill="#000000">
                    <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"/>
                    <rect fill="#000000" opacity="0.5"
                          transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                          x="0" y="7" width="16" height="2" rx="1"/>
                </g>
            </svg>
        </span>
        <!--end::Svg Icon-->
    </div>
    <!--end::Close-->
</div>
<!--begin::Modal header-->
<!--begin::Modal body-->
<div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
    <!--begin:Form-->
    <form id="form_create_literatur">
        <!--begin::Heading-->
        <div class="mb-13 text-center">
            <!--begin::Title-->
            <h1 class="mb-3">Add Literatur</h1>
            <!--end::Title-->
            <!--begin::Description-->

            <!--end::Description-->
        </div>
        <!--end::Heading-->
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row">
            <!--begin::Label-->
            <label for="judul_literatur" class="d-flex align-items-center fs-6 fw-bold mb-2">
                <span class="required">Judul Literatur</span>
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                   title="Specify a target name for future usage and reference"></i>
            </label>
            <!--end::Label-->
            <input type="text" class="form-control form-control-solid" placeholder="Judul Literatur" name="judul"
                   id="judul_literatur" value="{{$literatur->judul}}"/>
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label for="penulis_literatur" class="required fs-6 fw-bold mb-2">Penulis</label>
                <input type="text" class="form-control form-control-solid" placeholder="Penulis" name="penulis"
                       id="penulis_literatur" value="{{$literatur->penulis}}"/>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label for="tahun_terbit_literatur" class="required fs-6 fw-bold mb-2">Tahun Terbit</label>
                <!--begin::Input-->
                <div class="position-relative d-flex align-items-center">
                    <!--begin::Icon-->
                    <!--end::Icon-->
                    <!--begin::Datepicker-->
                    <input type="number" class="form-control form-control-solid" placeholder="Tahun Terbit"
                           name="tahun_terbit" id="tahun_terbit_literatur" value="{{$literatur->tahun_terbit}}"/>
                    <!--end::Datepicker-->
                </div>
                <!--end::Input-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row">
            <!--begin::Label-->
            <label for="tag_literatur" class="d-flex align-items-center fs-6 fw-bold mb-2">
                <span class="required">Tag</span>
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                   title="Masukkan tag yang berhubungan dengan literatur ini"></i>
            </label>
            <!--end::Label-->
            @if($literatur->tag == null)
                <select class="form-control form-control-solid form-select form-select-sm" name="tag">
                    <option disabled selected>Tag</option>
                    <option value='Konsep Peluang'>Konsep Peluang</option>
                    <option value='Variabel Acak'>Variabel Acak</option>
                    <option value='Distribusi Probabilitas Diskrit'>Distribusi Probabilitas Diskrit</option>
                    <option value='Distribusi Probabilitas Kontinu'>Distribusi Probabilitas Kontinu</option>
                    <option value='Pengantar Statistik dan Analisis Data'>Pengantar Statistik dan Analisis Data</option>
                    <option value='Teknik Sampling'>Teknik Sampling</option>
                    <option value='ANOVA'>ANOVA</option>
                    <option value='Konsep Estimasi'>Konsep Estimasi</option>
                    <option value='Pengujian Hipotesis'>Pengujian Hipotesis</option>
                    <option value='Regresi Korelasi'>Regresi Korelasi</option>
                </select>
            @else
                <select class="form-select form-select-sm" name="tag">
                    <option value='Konsep Peluang' {{ $literatur->tag == 'Konsep Peluang' ? 'selected' : '' }}>
                        Konsep Peluang
                    </option>
                    <option value='Variabel Acak' {{ $literatur->tag == 'Variabel Acak' ? 'selected' : '' }}>
                        Variabel Acak
                    </option>
                    <option value='Distribusi Probabilitas Diskrit' {{ $literatur->tag == 'Distribusi Probabilitas Diskrit' ? 'selected' : '' }}>
                        Distribusi Probabilitas Diskrit
                    </option>
                    <option value='Distribusi Probabilitas Kontinu' {{ $literatur->tag == 'Distribusi Probabilitas Kontinu' ? 'selected' : '' }}>
                        Distribusi Probabilitas Kontinu
                    </option>
                    <option value='Pengantar Statistik dan Analisis Data' {{ $literatur->tag == 'Pengantar Statistik dan Analisis Data' ? 'selected' : '' }}>
                        Pengantar Statistik dan Analisis Data
                    </option>
                    <option value='Teknik Sampling' {{ $literatur->tag == 'Teknik Sampling' ? 'selected' : '' }}>
                        Teknik Sampling
                    </option>
                    <option value='ANOVA' {{ $literatur->tag == 'ANOVA' ? 'selected' : '' }}>
                        ANOVA
                    </option>
                    <option value='Konsep Estimasi' {{ $literatur->tag == 'Konsep Estimasi' ? 'selected' : '' }}>
                        Konsep Estimasi
                    </option>
                    <option value='Pengujian Hipotesis' {{ $literatur->tag == 'Pengujian Hipotesis' ? 'selected' : '' }}>
                        Pengujian Hipotesis
                    </option>
                    <option value='Regresi Korelasi' {{ $literatur->tag == 'Regresi Korelasi' ? 'selected' : '' }}>
                        Regresi Korelasi
                    </option>
                </select>
            @endif
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row">
            <!--begin::Label-->
            <label for="file_literatur" class="d-flex align-items-center fs-6 fw-bold mb-2">
                <span class="required">File</span>
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                   title="File yang diterima hanya berformat pdf"></i>
            </label>
            <div class="form-text">Allowed file types: pdf.</div>
            <!--end::Label-->
            <input type="file" class="form-control form-control-solid" name="file" id="file_literatur"
                   value="{{$literatur->file}}"/>
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->

        <!--end::Input group-->
        <!--begin::Actions-->
        <div class="text-center pt-15">
            @if ($literatur->id)
                <button id="tombol_kirim_literatur"
                        onclick="upload_form_modal('#tombol_kirim_literatur','#form_create_literatur','{{route('literatur.update', $literatur->id)}}','#ModalCreateLiteratur','POST');"
                        class="btn btn-primary">
                    Submit
                </button>
            @else
                <button id="tombol_kirim_literatur"
                        onclick="upload_form_modal('#tombol_kirim_literatur','#form_create_literatur','{{route('literatur.store')}}','#ModalCreateLiteratur','POST');"
                        class="btn btn-primary">
                    Submit
                </button>
            @endif
        </div>
        <!--end::Actions-->
    </form>
    <!--end:Form-->
</div>
<!--end::Modal body-->


<script>
    var loadFile = function (event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
