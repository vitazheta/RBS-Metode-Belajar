<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import CSV</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Upload CSV</h2>
    <form action="{{ route('import.process') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="csv_file" class="form-control mb-3" required>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>

    @if(session('data'))
        <h3 class="mt-4">Preview Data</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    @foreach(session('data')[0] as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach(array_slice(session('data'), 1) as $row)
                    <tr>
                        @foreach($row as $cell)
                            <td>{{ $cell }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
