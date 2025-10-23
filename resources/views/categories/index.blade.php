<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Category Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #001F54, #205fb3ff);
            min-height: 100vh;
            color: #f8f9fa;
            font-family: "Segoe UI", sans-serif;
            display: flex;
        }

        /* === SIDEBAR === */
        .sidebar {
            width: 250px;
            background-color: #0d1b2a;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.3);
        }

        .sidebar h3 {
            color: #fff;
            font-weight: 700;
            margin-bottom: 40px;
            text-align: center;
        }

        .sidebar a {
            display: block;
            width: 100%;
            padding: 12px 15px;
            color: #f8f9fa;
            text-decoration: none;
            font-weight: 600;
            border-radius: 10px;
            margin-bottom: 10px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #205fb3;
            transform: translateX(5px);
        }

        /* === MAIN CONTENT === */
        .main-content {
            flex: 1;
            padding: 40px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        table.table thead {
            background-color: #0d6efd;
            color: white;
            text-transform: uppercase;
        }

        table.table tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.08);
        }

        table th, table td {
            vertical-align: middle;
            text-align: center;
        }

        h2 {
            color: #fff;
            text-shadow: 1px 1px 5px rgba(0,0,0,0.3);
            font-weight: 700;
        }

        hr {
            border-color: #ffffff66;
        }
    </style>
</head>
<body>

    <!-- ✅ SIDEBAR -->
    <div class="sidebar">
        <h3>Dashboard</h3>
        <a href="{{ route('suppliers.index') }}">Supplier</a>
        <a href="{{ route('transactions.index') }}">Transaksi</a>
        <a href="{{ route('products.index') }}">Product</a>
        <a href="{{ route('categories.index') }}" class="active">Category Products</a>
    </div>

    <!-- ✅ MAIN CONTENT -->
    <div class="main-content">
        <h2 class="text-center my-4">Dashboard Category Product</h2>
        <hr>

        <div class="card border-0 shadow-sm rounded p-3">
            <div class="card-body">
                <a href="{{ route('categories.create') }}" class="btn btn-md btn-success mb-3">+ TAMBAH KATEGORI</a>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">NAMA KATEGORI PRODUK</th>
                                <th scope="col" style="width: 20%">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $index => $category)
                            <tr>
                                <td class="text-center">{{ $index + $categories->firstItem() }}</td>
                                <td>{{ $category->product_category_name }}</td>
                                <td class="text-center">
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="delete-form d-inline">
                                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-secondary">SHOW</a>
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" id="btn-delete" data-title="{{ $category->product_category_name }}">
                                            HAPUS
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-danger fw-bold py-3">
                                        Belum ada data kategori produk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>

<!-- ✅ Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
@if(session('success'))
    Swal.fire({
        icon: "success",
        title: "BERHASIL",
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000
    });
@elseif(session('error'))
    Swal.fire({
        icon: "error",
        title: "GAGAL!",
        text: "{{ session('error') }}",
        showConfirmButton: false,
        timer: 2000
    });
@endif

// Konfirmasi hapus
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        let title = form.querySelector('#btn-delete').getAttribute('data-title');
        Swal.fire({
            title: 'Yakin hapus kategori "' + title + '"?',
            text: "Data kategori akan dihapus permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#198754',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });
});
</script>

</body>
</html>
