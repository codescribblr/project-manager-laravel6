<div class="form-group">
    <label for="hostname">Server Hostname</label>
    <input type="text" name="hostname" class="form-control" required id="hostname" placeholder="Enter server hostname" value="{{ old('hostname') ? old('hostname') : @$server->hostname }}">
    <small class="form-text text-danger">{{ $errors->first('hostname') }}</small>
</div>
<div class="form-group">
    <label for="public_ip">Server Public IP</label>
    <input type="text" name="public_ip" class="form-control" required id="public_ip" placeholder="Enter server public ip" value="{{ old('public_ip') ? old('public_ip') : @$server->public_ip }}">
    <small class="form-text text-danger">{{ $errors->first('public_ip') }}</small>
</div>
<div class="form-group">
    <label for="platform">Server Platform</label>
    <input type="text" name="platform" class="form-control" required id="platform" placeholder="AWS, DO, Linode, etc." value="{{ old('platform') ? old('platform') : @$server->platform }}">
    <small class="form-text text-danger">{{ $errors->first('platform') }}</small>
</div>
<div class="form-group">
    <label for="cost">Server Monthly Cost</label>
    <input type="number" name="cost" class="form-control" id="cost" placeholder="Enter cost in whole cents" value="{{ old('cost') ? old('cost') : @$server->cost }}">
    <small class="form-text text-danger">{{ $errors->first('cost') }}</small>
</div>
<div class="form-group">
    <label for="slots">Server Total Slots</label>
    <input type="number" name="slots" class="form-control" id="slots" placeholder="# of slots" value="{{ old('slots') ? old('slots') : @$server->slots }}">
    <small class="form-text text-danger">{{ $errors->first('slots') }}</small>
</div>
<div class="form-group">
    <label for="capacity">Server Capacity</label>
    <textarea name="capacity" class="form-control" id="capacity" placeholder="vCPUs, RAM, SSD, etc.">{{ old('capacity') ? old('capacity') : @$server->capacity }}</textarea>
    <small class="form-text text-danger">{{ $errors->first('capacity') }}</small>
</div>
@if(isset($server->status))
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="custom-select">
            <option value="active" {{ old('status') === 'active' ? 'selected' : ($server->status === 'active' ? 'selected' : '') }}>Active</option>
            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : ($server->status === 'inactive' ? 'selected' : '') }}>Inactive</option>
        </select>
    </div>
@endif