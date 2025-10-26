<!-- dropdown.blade.php -->
<select name="customer_id" class="form-control" id="customer_id"required>
    <option selected disabled>Select Customer</option>
    @foreach ($categories as $categoryId => $categoryName)
        <option value="{{ $categoryId }}" >
            {{ $categoryName }}
        </option>
    @endforeach
</select>
{{-- <select class="form-select" aria-label="Default select example" name="status" id="status">
    <option selected>Open this select menu</option>
    <option value="1">Active</option>
    <option value="0">In Active</option>
  </select> --}}