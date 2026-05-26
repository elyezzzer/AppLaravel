@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Perfil
    </h2>
@endsection

@section('slot')

<div class="py-10">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Informações do Perfil</h2>
            </div>

            <div class="p-6 flex items-start gap-10">

                <div class="flex flex-col items-center gap-3 min-w-[140px] shrink-0">

                    <div class="avatar-wrap group relative w-28 h-28 rounded-full overflow-hidden cursor-pointer p-[3px] bg-gradient-to-br from-[#1565ff] to-[#6db3ff]">
                        
                        @if (auth()->user()->foto_perfil)
                            <img
                                id="fotoAtual"
                                src="{{ auth()->user()->foto_perfil }}"
                                alt="Foto de perfil"
                                class="block w-full h-full rounded-full object-cover border-[3px] border-white"
                            >
                        @else
                            <div class="w-full h-full rounded-full border-[3px] border-white bg-gray-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.2" stroke="currentColor" class="w-12 h-12 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>
                            </div>
                        @endif

                        <div class="avatar-overlay absolute inset-[3px] rounded-full flex flex-col items-center justify-center gap-1.5 bg-black/0 group-hover:bg-black/46 transition-all duration-200 z-10">
                            @if (auth()->user()->foto_perfil)
                                <button id="btnEditPhoto" type="button" 
                                    class="ov-btn opacity-0 invisible translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-150 bg-white/95 text-xs font-semibold text-slate-800 px-3.5 py-1.5 rounded-md border-0 cursor-pointer w-[72px] whitespace-nowrap">
                                    Editar
                                </button>
                            @endif
                            <button id="btnChangePhoto" type="button" 
                                class="ov-btn opacity-0 invisible translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-150 bg-white/95 text-xs font-semibold text-slate-800 px-3.5 py-1.5 rounded-md border-0 cursor-pointer w-[72px] whitespace-nowrap delay-75">
                                Alterar
                            </button>
                        </div>

                    </div>

                    <div class="text-center">
                        <p class="text-sm font-medium text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-400 mt-0.5 truncate max-w-[130px]">{{ auth()->user()->email }}</p>
                    </div>
                </div>

                <div class="w-px bg-gray-100 self-stretch"></div>

                <div class="flex-1">
                    @include('profile.partials.update-profile-information-form')
                </div>

            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Alterar Senha</h2>
            </div>
            <div class="p-6 max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Excluir Conta</h2>
            </div>
            <div class="p-6 max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</div>

{{-- Modal Edit --}}
<div id="modalEdit"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-200"
     role="dialog" aria-modal="true">

    <div id="modalEditBox"
         class="bg-white rounded-xl w-full max-w-[480px] p-7 shadow-2xl max-h-[92vh] overflow-y-auto translate-y-4 scale-95 transition-all duration-200 ease-out">

        <p class="text-sm font-semibold text-gray-900 mb-4">Editar foto de perfil</p>
        <div id="cropperWrapper"></div>
        <div class="flex justify-end gap-2.5 mt-5">
            <button id="cancelEdit" type="button"
                class="px-4 py-2 text-sm font-medium text-gray-600 border border-gray-200 rounded-lg hover:border-gray-400 hover:text-gray-800 transition-colors">
                Cancelar
            </button>
            <button id="saveEdit" type="button"
                class="px-4 py-2 text-sm font-semibold text-white bg-[#1565ff] rounded-lg hover:bg-[#0f4ed1] disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                Salvar foto
            </button>
        </div>
    </div>
</div>

{{-- Modal Upload --}}
<div id="modalUpload"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-200"
     role="dialog" aria-modal="true">

    <div id="modalUploadBox"
         class="bg-white rounded-xl w-full max-w-[480px] p-7 shadow-2xl max-h-[92vh] overflow-y-auto translate-y-4 scale-95 transition-all duration-200 ease-out">

        <p class="text-sm font-semibold text-gray-900 mb-4">Alterar foto de perfil</p>

        <div id="uploadStep">
            <div id="dropArea"
                 class="border-2 border-dashed border-gray-200 rounded-xl p-10 text-center cursor-pointer hover:border-[#1565ff] hover:bg-blue-50/40 transition-all duration-150">
                <input type="file" id="imageInput" accept="image/*" class="hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-300 mx-auto mb-3">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/>
                </svg>
                <p class="text-sm text-gray-500">
                    <span class="text-[#1565ff] font-semibold">Clique para selecionar</span> ou arraste aqui
                </p>
                <p class="text-xs text-gray-400 mt-1.5">JPG, PNG ou WEBP · máx. 10 MB</p>
            </div>
            <div class="flex justify-end mt-4">
                <button id="cancelUpload" type="button"
                    class="px-4 py-2 text-sm font-medium text-gray-600 border border-gray-200 rounded-lg hover:border-gray-400 hover:text-gray-800 transition-colors">
                    Cancelar
                </button>
            </div>
        </div>

        <div id="cropStep" class="hidden">
            <div id="cropperWrapperUpload"></div>
            <div class="flex justify-end gap-2.5 mt-5">
                <button id="backToUpload" type="button"
                    class="px-4 py-2 text-sm font-medium text-gray-600 border border-gray-200 rounded-lg hover:border-gray-400 hover:text-gray-800 transition-colors">
                    ← Voltar
                </button>
                <button id="saveUpload" type="button"
                    class="px-4 py-2 text-sm font-semibold text-white bg-[#1565ff] rounded-lg hover:bg-[#0f4ed1] disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                    Salvar foto
                </button>
            </div>
        </div>

    </div>
</div>

{{-- Assets --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>

<script>
    const btnEditPhoto         = document.getElementById('btnEditPhoto');
    const btnChangePhoto       = document.getElementById('btnChangePhoto');
    const modalEdit            = document.getElementById('modalEdit');
    const modalEditBox         = document.getElementById('modalEditBox');
    const cancelEditBtn        = document.getElementById('cancelEdit');
    const saveEditBtn          = document.getElementById('saveEdit');
    const cropperWrapper       = document.getElementById('cropperWrapper');
    const modalUpload          = document.getElementById('modalUpload');
    const modalUploadBox       = document.getElementById('modalUploadBox');
    const cancelUploadBtn      = document.getElementById('cancelUpload');
    const dropArea             = document.getElementById('dropArea');
    const imageInput           = document.getElementById('imageInput');
    const uploadStep           = document.getElementById('uploadStep');
    const cropStep             = document.getElementById('cropStep');
    const cropperWrapperUpload = document.getElementById('cropperWrapperUpload');
    const saveUploadBtn        = document.getElementById('saveUpload');
    const backToUploadBtn      = document.getElementById('backToUpload');

    let cropperEdit = null, cropperUpload = null, originalFile = null;

    function openModal(b, box)  { 
        b.classList.remove('opacity-0','pointer-events-none'); 
        box.classList.remove('translate-y-4','scale-95'); 
        document.body.style.overflow='hidden'; 
    }
    function closeModal(b, box) { 
        b.classList.add('opacity-0','pointer-events-none');    
        box.classList.add('translate-y-4','scale-95');    
        document.body.style.overflow=''; 
    }

    [modalEdit, modalUpload].forEach(m => m.addEventListener('click', e => { if (e.target===m) closeAll(); }));
    document.addEventListener('keydown', e => { if (e.key==='Escape') closeAll(); });

    function closeAll() {
        closeModal(modalEdit, modalEditBox);
        closeModal(modalUpload, modalUploadBox);
        safeDestroy(cropperEdit);   cropperEdit=null;   cropperWrapper.innerHTML='';
        safeDestroy(cropperUpload); cropperUpload=null;
        resetUploadStep();
    }

    function safeDestroy(c) { if (c) { try { c.destroy(); } catch(_) {} } }

    function initCropper(wrapper, src, cb) {
        wrapper.innerHTML = '';
        const img = document.createElement('img');
        wrapper.appendChild(img);
        img.onload = () => cb(new Cropper(img, {
            aspectRatio:1, viewMode:1, dragMode:'move',
            autoCropArea:1, responsive:true, background:false,
            restore:false, checkCrossOrigin:false,
        }));
        img.src = src;
    }

    function resetUploadStep() {
        uploadStep.classList.remove('hidden');
        cropStep.classList.add('hidden');
        imageInput.value = ''; originalFile = null;
        cropperWrapperUpload.innerHTML = '';
        safeDestroy(cropperUpload); cropperUpload = null;
    }

    if (btnEditPhoto) {
        btnEditPhoto.addEventListener('click', () => {
            const src = "{{ auth()->user()->foto_perfil }}";
            openModal(modalEdit, modalEditBox);
            initCropper(cropperWrapper, src, c => { cropperEdit = c; });
        });
    }

    cancelEditBtn.addEventListener('click', () => {
        closeModal(modalEdit, modalEditBox);
        safeDestroy(cropperEdit); cropperEdit=null; cropperWrapper.innerHTML='';
    });

    btnChangePhoto.addEventListener('click', () => { resetUploadStep(); openModal(modalUpload, modalUploadBox); });
    cancelUploadBtn.addEventListener('click', () => { closeModal(modalUpload, modalUploadBox); resetUploadStep(); });

    dropArea.addEventListener('click',    () => imageInput.click());
    dropArea.addEventListener('dragover',  e => { e.preventDefault(); dropArea.classList.add('!border-[#1565ff]'); });
    dropArea.addEventListener('dragleave', () => dropArea.classList.remove('!border-[#1565ff]'));
    dropArea.addEventListener('drop', e => { e.preventDefault(); dropArea.classList.remove('!border-[#1565ff]'); handleFile(e.dataTransfer.files[0]); });
    imageInput.addEventListener('change', e => handleFile(e.target.files[0]));

    function handleFile(file) {
        if (!file || !file.type.startsWith('image/')) { alert('Arquivo inválido'); return; }
        originalFile = file;
        const reader = new FileReader();
        reader.onload = e => {
            uploadStep.classList.add('hidden');
            cropStep.classList.remove('hidden');
            initCropper(cropperWrapperUpload, e.target.result, c => { cropperUpload = c; });
        };
        reader.readAsDataURL(file);
    }

    backToUploadBtn.addEventListener('click', () => {
        safeDestroy(cropperUpload); cropperUpload=null;
        uploadStep.classList.remove('hidden'); cropStep.classList.add('hidden');
        cropperWrapperUpload.innerHTML=''; imageInput.value=''; originalFile=null;
    });

    async function doSave(instance, btn, withOriginal) {
        if (!instance) return;
        const canvas = instance.getCroppedCanvas({ width:400, height:400 });
        const blob   = await new Promise(r => canvas.toBlob(r, 'image/jpeg', 0.92));
        const fd = new FormData();
        fd.append('foto', blob, 'foto.jpg');
        if (withOriginal && originalFile) fd.append('original', originalFile, 'original.jpg');
        btn.disabled = true; btn.textContent = 'Salvando…';
        try {
            const res = await fetch('{{ route("profile.photo") }}', {
                method:'POST',
                headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}', 'Accept':'application/json' },
                body: fd,
            });
            if (!res.ok) throw new Error('HTTP ' + res.status);
            location.reload();
        } catch(err) {
            alert('Erro ao salvar: ' + err.message);
            btn.disabled=false; btn.textContent='Salvar foto';
        }
    }

    saveEditBtn.addEventListener('click',   () => doSave(cropperEdit,   saveEditBtn,   false));
    saveUploadBtn.addEventListener('click', () => doSave(cropperUpload, saveUploadBtn, true));
</script>

@endsection