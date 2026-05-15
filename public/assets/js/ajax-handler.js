/**
 * Simple AJAX Handler for Capacities Platform
 */

const API = {
    async get(url) {
        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            return await response.json();
        } catch (error) {
            console.error('API GET Error:', error);
            return { error: 'Connection failed' };
        }
    },

    async post(url, data) {
        try {
            const formData = new FormData();
            for (const key in data) {
                formData.append(key, data[key]);
            }
            
            // Add CSRF token if exists
            const csrfToken = document.querySelector('input[name="csrf_token"]');
            if(csrfToken) formData.append('csrf_token', csrfToken.value);

            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });
            return await response.json();
        } catch (error) {
            console.error('API POST Error:', error);
            return { error: 'Connection failed' };
        }
    }
};
