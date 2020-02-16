@if(!isset($task->project))
    @if(isset($project))
        <input type="hidden" name="project" value="{{ $project->id }}" />
    @else
        <div class="form-group">
            <label for="project">Project</label>
            <select name="project" id="project" class="custom-select">
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ old('project') === $project->id ? 'selected' : ($task->project === $project ? 'selected' : '') }}>{{ $project->name }}</option>
                @endforeach
            </select>
        </div>
    @endif
@endif
<div class="form-group">
    <label for="name">Task Name</label>
    <input type="text" name="name" class="form-control" required id="name" placeholder="Enter task name" value="{{ old('name') ? old('name') : @$task->name }}">
    <small class="form-text text-danger">{{ $errors->first('name') }}</small>
</div>
<div class="form-group">
    <label for="description">Task Description</label>
    <textarea name="description" class="form-control" id="description" placeholder="Enter task description">{{ old('description') ? old('description') : @$task->description }}</textarea>
    <small class="form-text text-danger">{{ $errors->first('description') }}</small>
</div>
<div class="form-group">
    <label for="start_date">Task Start Date</label>
    <input type="date" name="start_date" class="form-control" id="start_date" placeholder="yyyy-mm-dd" value="{{ old('start_date') ? old('start_date') : @$task->start_date }}">
    <small class="form-text text-danger">{{ $errors->first('start_date') }}</small>
</div>
<div class="form-group">
    <label for="due_date">Task Due Date</label>
    <input type="date" name="due_date" class="form-control" id="due_date" placeholder="yyyy-mm-dd" value="{{ old('due_date') ? old('due_date') : @$task->due_date }}">
    <small class="form-text text-danger">{{ $errors->first('due_date') }}</small>
</div>
@if(isset($task->status))
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="custom-select">
            <option value="open" {{ old('status') === 'open' ? 'selected' : ($task->status === 'open' ? 'selected' : '') }}>Open</option>
            <option value="completed" {{ old('status') === 'completed' ? 'selected' : ($task->status === 'completed' ? 'selected' : '') }}>Completed</option>
        </select>
    </div>
@endif