<div class="modal modal-blur fade" id="modal-team" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a new team</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3 align-items-end">
                    <div class="d-flex justify-content-center">
                        <a href="#" class="avatar avatar-upload rounded" onclick="$('#pImage').click();">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                            <span class="avatar-upload-text">Əlavə et</span>
                        </a>
                        <form action="{{ route('back.photo.save') }}" id="photo-form" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="product_id" id="product_id">
                            <input type="file" name="image[]" class="d-none" id="pImage" multiple>
                        </form>
                    </div>
                    <div class="gallery" style="position: relative"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto d-none closeBtn" data-bs-dismiss="modal">Bağla</button>
                <button type="button" class="btn btn-primary d-none" data-bs-dismiss="modal">Əlavə et</button>
            </div>
        </div>
    </div>
</div>

<div class="d-none">
    <form action="{{ route('back.photo.delete') }}" method="POST">
        @csrf
        <input type="hidden" name="image_id" id="image_id">
        <button id="imageDeleteBtn" onclick="return confirm('Silmək istədiyinizdən əminsiniz?')">Sil</button>
    </form>
</div>
