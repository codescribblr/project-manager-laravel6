<div class="form-group">
    <label for="name">Client Name</label>
    <input type="text" name="name" class="form-control warning" required id="name" placeholder="Enter client name" value="{{ old('name') ? old('name') : @$client->name }}">
    <small class="form-text text-danger">{{ $errors->first('name') }}</small>
</div>
<div class="form-group">
    <label for="contact_name">Contact Name</label>
    <input type="text" name="contact_name" class="form-control" id="contact_name" placeholder="Enter contact name" value="{{ old('contact_name') ? old('contact_name') : @$client->contact_name }}">
    <small class="form-text text-danger">{{ $errors->first('contact_name') }}</small>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Contact Email</label>
    <input type="email" name="contact_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="{{ old('contact_email') ? old('contact_email') : @$client->contact_email }}">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    <small class="form-text text-danger">{{ $errors->first('contact_email') }}</small>
</div>
<div class="form-group">
    <label for="phone">Contact Phone</label>
    <input type="tel" name="contact_phone" class="form-control" id="phone" placeholder="Enter phone" value="{{ old('contact_phone') ? old('contact_phone') : @$client->contact_phone }}">
    <small class="form-text text-danger">{{ $errors->first('contact_phone') }}</small>
</div>
@if(isset($client->status))
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="custom-select">
            <option value="active" {{ old('status') === 'active' ? 'selected' : ($client->status === 'active' ? 'selected' : '') }}>Active</option>
            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : ($client->status === 'inactive' ? 'selected' : '') }}>Inactive</option>
        </select>
    </div>
@endif