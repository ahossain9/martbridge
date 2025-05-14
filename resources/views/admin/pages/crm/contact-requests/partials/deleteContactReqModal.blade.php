<div class="modal fade modal-danger text-start" id="deleteContactReqModal-{{ $contact->id }}" tabindex="-1"
     aria-labelledby="deleteContactReqModal-{{ $contact->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteContactReqModal-{{ $contact->id }}">!!! Delete Confirmation !!! <span
                        class="badge badge-glow bg-info"> {{ $contact->subject }}</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure to delete this contact request? It will not be possible to recover it anymore.
            </div>
            <form action="{{ route('admin.crm.contact_requests.destroy', $contact->id) }}"
                  method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-danger">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
