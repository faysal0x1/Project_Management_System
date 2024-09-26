<div class="action-buttons">
    {{-- Edit Button --}}
    @if ($editRoute)
        <a href="{{ route($role . $editRoute, $id) }}" class="">
            <i class="fas fa-edit"></i>
        </a>
    @endif

    {{-- Delete Button --}}
    @if ($deleteRoute)
        <form action="{{ route($role . $deleteRoute, $id) }}" method="POST" class="delete-form" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="button" class="delete-btn" data-id="{{ $id }}" data-model={{ $model ?? '' }}>
                <i class="fas fa-trash"></i>
            </button>
        </form>
    @endif
    {{-- View Button (Set default to false if not defined) --}}
    @if (isset($viewRoute) && $viewRoute)
        <a href="{{ route($role . $viewRoute, $id) }}" class="">
            <i class="fas fa-eye"></i>
        </a>
    @endif

    {{-- Download Button --}}
    @if (isset($showDownload) && $showDownload && $downloadRoute)
        <a href="{{ route($role . $downloadRoute, $id) }}" class="">
            <i class="fas fa-download"></i>
        </a>
    @endif

    {{-- PDF Button --}}
    @if (isset($showPdf) && $showPdf && $pdfRoute)
        <a href="{{ route($role . $pdfRoute, $id) }}" class="">
            <i class="fas fa-file-pdf"></i>
        </a>
    @endif

    {{-- Mail Button --}}
    @if (isset($showMail) && $showMail && $mailRoute)
        <a href="{{ route($role . $mailRoute, $id) }}" class="">
            <i class="fas fa-envelope"></i>
        </a>
    @endif
</div>
