@foreach($children as $row_child)
    @php
        $percent = '%';
    @endphp
    <input type="hidden" name="menu_id[]" value="{{ $row_child->id }}">

    <tr id="collapse{{$row_child->parent_id}}" class="hidden collapse">
        <td style="width: {{ $width . $percent }}; text-align: center; vertical-align: middle; text-align: right;">
            @if($row_child->children->count() > 0)
                <span class="caret" data-toggle="collapse" data-target="#collapse{{$row_child->id}}"></span>
            @endif
            <ul class="nested"></ul>
        </td>

        <td style="width: auto;">
            @if($row_child->editabled == 1 && $row_child->type_doc == 0)
            <input type="text" name="menu_name[]" value="{{ $row_child->menu_name }}" class="form-control form-control-sm" required>
            @else
                <input type="text" name="menu_name[]" value="{{ $row_child->menu_name }}" class="form-control form-control-sm" readonly>
            @endif
                <input type="hidden" name="type_doc[]" value="{{ $row_child->type_doc }}" class="form-control form-control-sm" readonly>
        </td>

        <td style="width: auto;">
            @if($row_child->editabled == 0)
                <select name="parent_id[]" class="form-control form-control-sm" disabled="true">
                    <option value="0" selected>{{ '-Pilih Menu Parent-' }}</option>
                </select>
                <input type="hidden" name="parent_id[]" value="0"/>
            @else
                <select name="parent_id[]" class="form-control form-control-sm">
                    <option value="0">{{ '-Pilih Menu Parent-' }}</option>
                    @foreach($menus_name as $row_parent)
                        <option value="{{ $row_parent->id }}" @if($row_child->parent_id == $row_parent->id) selected @endif>{{ $row_parent->menu_name }}</option>
                    @endforeach
                </select>
            @endif
        </td>
        <td style="width: auto;">
            <input type="text" name="slug[]" value="{{ $row_child->slug }}" class="form-control form-control-sm" readonly>
            <input type="hidden" name="editabled[]" value="{{ $row_child->editabled }}" class="form-control form-control-sm" readonly>
        </td>
        <td style="width: auto;">
            <input type="text" name="free_link[]" value="{{ $row_child->free_link }}" class="form-control form-control-sm">
        </td>

        <td style="width: auto;">
            @if($row_child->type_doc == 0 && $row_child->parent_id != 0 && $row_child->editabled == 1)
                <select name="type_ruledoc[]" class="form-control form-control-sm">
                    <option value="0">{{ '-Pilih Peraturan-' }}</option>
                    @foreach($rules_name as $row_rules)
                        <option value="{{ $row_rules->id }}" @if($row_child->type_ruledoc == $row_rules->id) selected @endif>{{ $row_rules->type_name }}</option>
                    @endforeach
                </select>
            @else
                <select name="type_ruledoc[]" class="form-control form-control-sm" disabled="true">
                    <option value="0" selected>{{ '-Pilih Peraturan-' }}</option>
                </select>
                <input type="hidden" name="type_ruledoc[]" value="0"/>
            @endif
        </td>
        
        <td style="width: auto;">
            <select name="page_id[]" class="form-control form-control-sm">
                <option value="0">{{ '-Pilih Page-' }}</option>
                @foreach($pages_name as $row_pages)
                    <option value="{{ $row_pages->id }}" @if($row_child->page_id == $row_pages->id) selected @endif>{{ $row_pages->page_name }}</option>
                @endforeach
            </select>
        </td>

        <td style="width: 5%;">
            @if($row_child->editabled == 0)
                <input type="text" name="menu_order[]" value="0" class="form-control form-control-sm" readonly>
            @else
                <input type="text" name="menu_order[]" value="{{ $row_child->order }}" class="form-control form-control-sm">
            @endif
        </td>

        <td style="width: 8%;">
            <select name="menu_status[]" class="form-control form-control-sm">
                <option value="Show" @if($row_child->menu_status == 'Show') selected @endif>Show</option>
                <option value="Hide" @if($row_child->menu_status == 'Hide') selected @endif>Hide</option>
            </select>
        </td>
    </tr>
    
    @if($row_child->children->count() > 0)
        @php
            $widths = $width + 1;
        @endphp
        
        @include('admin.menu.subrow', ['children' => $row_child->children, 'width' => $widths])
    @endif
@endforeach