<!DOCTYPE html>
<html>
<head>
    <title>Monthly Report</title>
    <!-- Add your CSS styles here -->
</head>
<body>
<h1>Monthly Report</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>basic_salary</th>
        <!-- Add other table headers here -->
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->employee_id }}</td>
            <td>{{ $item->basic_salary }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
