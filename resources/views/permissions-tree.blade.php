<!-- permissions-tree.blade.php -->

<ul class="permission-tree">
    @foreach ($permissions as $permission)
    <li style="margin-left: {{ $permission->depth * 20 }}px;">

            <label>
                <input type="checkbox" class="checkbox" name="permissionsList[]" value="{{ $permission->id }}" @if ($data && in_array($permission->id, $data->user_type_permissions->pluck('permission_id')->toArray())) checked @endif>
                
                {{ $permission->name }}
            </label>
            @if ($permission->child && $permission->child->isNotEmpty())
                @include('permissions-tree', ['permissions' => $permission->child])
            @endif
        </li>
    @endforeach
</ul>

<script>
    // Attach event handlers after the checkboxes are rendered
    $(document).ready(function () {
        $('.permission-tree').on('change', 'input.checkbox', function () {
            toggleParents(this);
        });

        function toggleParents(checkbox) {
            var isChecked = $(checkbox).prop('checked');

            $(checkbox).parents('ul').siblings('label').children('input.checkbox').prop('checked', isChecked);

             // Check or uncheck parent checkboxes
             $(checkbox).parents('ul').each(function () {
                var hasCheckedChild = $(this).find('input.checkbox:checked').length > 0;
                $(this).siblings('label').children('input.checkbox').prop('checked', hasCheckedChild);
            });
        }

    });
</script>
