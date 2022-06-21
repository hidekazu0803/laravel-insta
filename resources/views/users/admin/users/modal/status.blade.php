<div class="modal fade" id="deactivate-user-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h5 class="modal-title text-danger">
                   <i class="fas fa-user-slash"></i> Deactivate
                </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               Are you sure to deactivate: {{ $user->name }}
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.users.deactivate',$user->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger btn-sm">Deactivate</button>

                </form>
            </div>
        </div>
    </div>
</div>

{{-- activate modal --}}
{{-- Modal --}}
<div class="modal fade" id="activate-user-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-success">
            <div class="modal-header border-success">
                <h5 class="modal-title text-success">
                   <i class="fas fa-user-check"></i> Activate
                </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               Are you sure to activate: {{  $user->name }}
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.users.activate',$user->id) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success btn-sm">Activate</button>

                </form>
            </div>
        </div>
    </div>
</div>
