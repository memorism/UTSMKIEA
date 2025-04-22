<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Service</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-6 text-center text-blue-700">Order Form</h1>

        <form id="orderForm" class="space-y-4">
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
                <select id="user_id" name="user_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>-- Loading Users... --</option>
                </select>
            </div>
            <div>
                <label for="product_id" class="block text-sm font-medium text-gray-700">Product</label>
                <select id="product_id" name="product_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>-- Loading Products... --</option>
                </select>
            </div>
            <div class="text-center">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                    Submit Order
                </button>
            </div>
        </form>

        <!-- Loading Spinner -->
        <div id="loading" class="hidden text-center mt-4">
            <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-8 w-8 mx-auto"></div>
            <p class="text-sm text-gray-600 mt-2">Processing order...</p>
        </div>

        <!-- Result -->
        <div class="mt-8" id="result-section" style="display: none;">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Order Result:</h2>
            <table class="w-full text-sm text-left text-gray-700 border border-gray-300 rounded-md">
                <tbody id="result-table"></tbody>
            </table>
        </div>
    </div>

    <!-- Tailwind Loader Style -->
    <style>
        .loader {
            border-top-color: #3490dc;
            animation: spin 1s infinite linear;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>

    <script>
        const form = document.getElementById('orderForm');
        const resultSection = document.getElementById('result-section');
        const resultTable = document.getElementById('result-table');
        const loading = document.getElementById('loading');
        const userSelect = document.getElementById('user_id');
        const productSelect = document.getElementById('product_id');

        // 🟢 Ambil Data User dan Product dari API
        window.onload = function () {
            loadUsers();
            loadProducts();
        };

        function loadUsers() {
            axios.get('http://127.0.0.1:8001/api/users')
                .then(response => {
                    userSelect.innerHTML = '<option value="" disabled selected>-- Pilih User --</option>';
                    response.data.forEach(user => {
                        userSelect.innerHTML += `<option value="${user.id}">${user.id} - ${user.name}</option>`;
                    });
                })
                .catch(() => {
                    userSelect.innerHTML = '<option value="" disabled selected>Gagal load user</option>';
                });
        }

        function loadProducts() {
            axios.get('http://127.0.0.1:8002/api/products')
                .then(response => {
                    productSelect.innerHTML = '<option value="" disabled selected>-- Pilih Product --</option>';
                    response.data.forEach(product => {
                        productSelect.innerHTML += `<option value="${product.id}">${product.id} - ${product.name}</option>`;
                    });
                })
                .catch(() => {
                    productSelect.innerHTML = '<option value="" disabled selected>Gagal load product</option>';
                });
        }

        // 🟠 Submit Order Logic
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            resultSection.style.display = 'none';
            loading.classList.remove('hidden');

            const user_id = userSelect.value;
            const product_id = productSelect.value;

            axios.post('/orders', {
                user_id: user_id,
                product_id: product_id
            })
                .then(response => {
                    loading.classList.add('hidden');
                    showSuccessAlert();
                    showResult(response.data);
                })
                .catch(error => {
                    loading.classList.add('hidden');
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: error.response?.data?.message || error.message
                    });
                });
        });

        function showSuccessAlert() {
            Swal.fire({
                icon: 'success',
                title: 'Order Successful!',
                showConfirmButton: false,
                timer: 1500
            });
        }

        function showResult(data) {
            resultSection.style.display = 'block';
            resultTable.innerHTML = ''; // clear previous

            const statusBadge = renderStatusBadge(data.status || 'Pending'); // Default 'Pending' kalau belum ada

            resultTable.innerHTML += `
        <tr class="border-t">
            <td colspan="2" class="p-2">
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h3 class="text-lg font-bold text-blue-600 mb-4">📝 Order Details ${statusBadge}</h3>
                    
                    <div class="mb-4">
                        <span class="font-semibold text-gray-700">Order ID:</span>
                        <span class="ml-2 bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-sm">${data.order_id}</span>
                    </div>

                    <div class="mb-4">
                        <h4 class="font-semibold text-gray-800 mb-2">👤 User Info</h4>
                        ${renderObjectTable(data.user)}
                    </div>

                    <div class="mb-4">
                        <h4 class="font-semibold text-gray-800 mb-2">📦 Product Info</h4>
                        ${renderObjectTable(data.product)}
                    </div>

                    <div class="mt-4">
                        <span class="font-semibold text-gray-700">Total:</span>
                        <span class="ml-2 bg-green-100 text-green-700 px-2 py-1 rounded-full text-sm">Rp ${formatRupiah(data.total)}</span>
                    </div>
                </div>
            </td>
        </tr>
    `;
        }

        function renderObjectTable(obj) {
            let table = `<table class="w-full text-sm text-left text-gray-600 border border-gray-200 rounded-md mb-2">`;
            for (const key in obj) {
                table += `
            <tr class="border-t">
                <td class="px-2 py-1 w-1/3 font-medium capitalize bg-gray-100">${key}</td>
                <td class="px-2 py-1">${obj[key]}</td>
            </tr>
        `;
            }
            table += `</table>`;
            return table;
        }

        function renderStatusBadge(status) {
            let colorClass = 'bg-yellow-100 text-yellow-800'; // Default Pending
            if (status.toLowerCase() === 'success') {
                colorClass = 'bg-green-100 text-green-800';
            } else if (status.toLowerCase() === 'failed') {
                colorClass = 'bg-red-100 text-red-800';
            }
            return `<span class="ml-2 px-2 py-1 rounded-full text-sm ${colorClass}">${status}</span>`;
        }

        function formatRupiah(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

    </script>
</body>

</html>