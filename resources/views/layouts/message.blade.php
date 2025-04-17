@if (session('success') || session('error') || session('info') || session('warning'))
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
        <div id="toastMessage" class="toast align-items-center text-white 
            {{ session('success') ? 'bg-success' : '' }}
            {{ session('error') ? 'bg-danger' : '' }}
            {{ session('info') ? 'bg-info' : '' }}
            {{ session('warning') ? 'bg-warning' : '' }}
            " role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') ?? session('error') ?? session('info') ?? session('warning') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif