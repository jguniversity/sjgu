<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
<script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

<script src="{{asset('assets/vendor/libs/hammer/hammer.js')}}"></script>
<script src="{{asset('assets/vendor/libs/i18n/i18n.js')}}"></script>
<script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>

<script src="{{asset('assets/vendor/js/menu.js')}}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{asset('assets/vendor/libs/shepherd/shepherd.js')}}"></script>

<!-- Main JS -->
<script src="{{asset('assets/js/main.js')}}"></script>

<!-- Page JS -->
@yield('script')

<script>
(function () {

    const birthdayUrl = @json(route('dashboard.birthday'));

    const listElement = document.getElementById('birthdayNotificationList');
    const totalElement = document.getElementById('birthdayTotal');
    const badgeElement = document.getElementById('birthdayNotificationBadge');

    function escapeHtml(value) {
        return String(value ?? '').replace(/[&<>"']/g, function (char) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            }[char];
        });
    }

    function showMessage(message, color = 'text-muted') {
        listElement.innerHTML = `
            <li class="list-group-item text-center py-4">
                <small class="${color}">${escapeHtml(message)}</small>
            </li>
        `;
    }

    async function loadBirthdayNotification() {

        try {

            console.log('Mengambil data ulang tahun:', birthdayUrl);

            const response = await fetch(birthdayUrl, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            });

            if (!response.ok) {
                throw new Error(
                    'HTTP Error: ' + response.status + ' ' + response.statusText
                );
            }

            const result = await response.json();

            console.log('Birthday Response:', result);

            if (!result.success || !Array.isArray(result.data)) {
                throw new Error('Format JSON response tidak sesuai.');
            }

            const users = result.data;
            const total = users.length;

            // Update total
            totalElement.textContent = total + ' orang';

            // Update badge notifikasi
            if (total > 0) {
                badgeElement.textContent = total;
                badgeElement.style.display = 'inline-block';
            } else {
                badgeElement.style.display = 'none';
            }

            // Jika tidak ada ulang tahun
            if (total === 0) {

                showMessage('Tidak ada ulang tahun hari ini.');

                return;
            }

            let html = '';

            
users.forEach(function (user) {
    const name = user.name || '-';
    const profileUrl = `/profile/${encodeURIComponent(user.encrypted_id)}`;

    const name2 = user.name.toLowerCase().replace(/\b\w/g, huruf => huruf.toUpperCase());

    const initials = name.trim()
        .split(/\s+/)
        .map(word => word.charAt(0))
        .slice(0, 2)
        .join('')
        .toUpperCase();

        html += `
            <li class="list-group-item list-group-item-action p-0">
                <a href="${profileUrl}"
                class="d-flex align-items-center text-decoration-none text-reset p-3">

                    <div class="avatar me-3">
                        <span class="avatar-initial rounded-circle bg-label-primary">
                            ${escapeHtml(initials)}
                        </span>
                    </div>

                    <div class="flex-grow-1">
                        <h6 class="mb-0">${escapeHtml(name2)}</h6>
                        <small class="text-muted">
                            ${escapeHtml(user.job)}
                        </small>
                    </div>

                    <div class="text-end">
                        <small class="text-primary">
                            ${escapeHtml(user.age)} tahun
                        </small>
                    </div>
                </a>
            </li>
        `;
});

            listElement.innerHTML = html;

        } catch (error) {

            console.error('Birthday Notification Error:', error);

            showMessage('Gagal memuat data ulang tahun.', 'text-danger');

        }
    }

    // Pastikan DOM sudah siap
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', loadBirthdayNotification);
    } else {
        loadBirthdayNotification();
    }

})();
</script>
