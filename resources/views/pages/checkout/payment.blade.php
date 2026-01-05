@extends('layouts.master')

@section('content')

<style>
    body {
        background: linear-gradient(135deg, #1a2332 0%, #2c3e50 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .payment-container {
        max-width: 600px;
        width: 100%;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .payment-card {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        text-align: center;
    }

    .order-info {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        border: 2px solid #dee2e6;
    }

    .order-number {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1a2332;
        margin-bottom: 0.5rem;
    }

    .order-amount {
        font-size: 2.5rem;
        font-weight: 900;
        color: #FFD700;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .payment-icon {
        font-size: 4rem;
        color: #FFD700;
        margin-bottom: 1rem;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
    }

    .payment-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1a2332;
        margin-bottom: 1rem;
    }

    .payment-subtitle {
        color: #6c757d;
        margin-bottom: 2rem;
    }

    .btn-pay-now {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        color: #1a2332;
        border: none;
        padding: 1.2rem 3rem;
        font-size: 1.3rem;
        font-weight: 800;
        border-radius: 50px;
        transition: all 0.3s;
        cursor: pointer;
        box-shadow: 0 8px 20px rgba(255, 215, 0, 0.3);
        width: 100%;
        margin-bottom: 1rem;
    }

    .btn-pay-now:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(255, 215, 0, 0.4);
    }

    .security-badge {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        color: #6c757d;
        margin-top: 1.5rem;
    }

    .loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(26, 35, 50, 0.9);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }

    .loading-overlay.active {
        display: flex;
    }

    .loading-content {
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
        margin: 0 auto 1rem;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

{{-- Loading Overlay --}}
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-content">
        <div class="spinner"></div>
        <h3>Processing Payment...</h3>
        <p>Please wait, do not close this page</p>
    </div>
</div>

<div class="payment-container">
    <div class="payment-card">
        <div class="payment-icon">
            <i class="bi bi-credit-card-2-front"></i>
        </div>

        <h1 class="payment-title">Complete Your Payment</h1>
        <p class="payment-subtitle">Click the button below to pay via Midtrans</p>

        <div class="order-info">
            <div class="order-number">Order #{{ $order->order_number }}</div>
            <div class="order-amount">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
        </div>

        <button id="pay-button" class="btn-pay-now">
            <i class="bi bi-lock-fill me-2"></i>Pay Now
        </button>

        <div class="security-badge">
            <i class="bi bi-shield-check"></i>
            <small>Secured by Midtrans Payment Gateway</small>
        </div>
    </div>
</div>

{{-- Midtrans Snap.js --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        // Show loading
        document.getElementById('loadingOverlay').classList.add('active');

        // Trigger Snap Payment
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                console.log('Payment Success:', result);
                document.getElementById('loadingOverlay').classList.remove('active');
                window.location.href = "{{ route('checkout.success') }}?order_id={{ $order->order_number }}";
            },
            onPending: function(result){
                console.log('Payment Pending:', result);
                document.getElementById('loadingOverlay').classList.remove('active');
                alert('Payment pending! Please complete your payment.');
                window.location.href = "{{ route('checkout.success') }}?order_id={{ $order->order_number }}";
            },
            onError: function(result){
                console.log('Payment Error:', result);
                document.getElementById('loadingOverlay').classList.remove('active');
                alert('Payment failed! Please try again.');
            },
            onClose: function(){
                console.log('Payment popup closed');
                document.getElementById('loadingOverlay').classList.remove('active');
                alert('You closed the payment window. Your order is still pending.');
            }
        });
    };
</script>

@endsection
