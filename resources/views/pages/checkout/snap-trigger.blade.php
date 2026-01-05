<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processing Payment...</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #1a2332 0%, #2c3e50 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .loading-container {
            text-align: center;
            color: white;
        }

        .spinner {
            border: 4px solid rgba(255, 215, 0, 0.3);
            border-top: 4px solid #FFD700;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
            margin: 0 auto 2rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        h2 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            color: #FFD700;
        }

        p {
            font-size: 1rem;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="loading-container">
        <div class="spinner"></div>
        <h2>Processing Payment...</h2>
        <p>Opening Midtrans payment window...</p>
        <p style="font-size: 0.85rem; margin-top: 1rem;">Please do not close this page</p>
    </div>

    {{-- Midtrans Snap.js --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script>
        // Auto-trigger Snap popup immediately
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                console.log('Payment Success:', result);
                // Redirect with success status
                window.location.href = "{{ route('checkout.success') }}?order_id={{ $order->order_number }}&payment_status=success";
            },
            onPending: function(result){
                console.log('Payment Pending:', result);
                // Redirect with pending status
                window.location.href = "{{ route('checkout.success') }}?order_id={{ $order->order_number }}&payment_status=pending";
            },
            onError: function(result){
                console.log('Payment Error:', result);
                alert('Payment failed! Please try again.');
                window.location.href = "{{ route('cart.index') }}";
            },
            onClose: function(){
                console.log('Payment popup closed');
                // User closed the popup, redirect to cart
                if (confirm('Payment cancelled. Do you want to try again?')) {
                    window.location.href = "{{ route('cart.index') }}";
                } else {
                    window.location.href = "/";
                }
            }
        });
    </script>
</body>
</html>
