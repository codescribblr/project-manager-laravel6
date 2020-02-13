@if(!isset($project->client))
    <div class="form-group">
        <label for="client">Client</label>
        <select name="client" id="client" class="custom-select">
            @foreach($clients as $client)
                <option value="{{ $client->id }}" {{ old('client') === $client->id ? 'selected' : ($project->client === $client ? 'selected' : '') }}>{{ $client->name }}</option>
            @endforeach
        </select>
    </div>
@endif
<div class="form-group">
    <label for="name">Project Name</label>
    <input type="text" name="name" class="form-control warning" required id="name" placeholder="Enter project name" value="{{ old('name') ? old('name') : @$project->name }}">
    <small class="form-text text-danger">{{ $errors->first('name') }}</small>
</div>
<div class="form-group">
    <label for="description">Project Description</label>
    <textarea name="description" class="form-control" id="description" placeholder="Enter project description">{{ old('description') ? old('description') : @$project->description }}</textarea>
    <small class="form-text text-danger">{{ $errors->first('description') }}</small>
</div>
<div class="form-group">
    <label for="private_info">Private Info</label>
    <textarea name="private_info" class="form-control" id="private_info" placeholder="Enter private data">{{ old('private_info') ? old('private_info') : @$project->private_info }}</textarea>
    <small class="form-text text-danger">{{ $errors->first('private_info') }}</small>
</div>
@if(isset($project->status))
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="custom-select">
            <option value="active" {{ old('status') === 'active' ? 'selected' : ($project->status === 'active' ? 'selected' : '') }}>Active</option>
            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : ($project->status === 'inactive' ? 'selected' : '') }}>Inactive</option>
        </select>
    </div>
@endif