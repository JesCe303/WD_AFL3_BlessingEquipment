    <style>
        .footer-info {
            background: linear-gradient(135deg, #1a2332 0%, #2c3e50 50%, #1a2332 100%);
            padding: 60px 0 40px;
            color: white;
            width: 100%;
            margin-top: 80px;
            position: relative;
            overflow: hidden;
        }

        .footer-info::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, transparent, #FFD700, transparent);
        }

        .footer-info::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(255, 215, 0, 0.02) 10px,
                rgba(255, 215, 0, 0.02) 20px
            );
            pointer-events: none;
        }

        .footer-info .container {
            position: relative;
            z-index: 1;
        }

        /* padding top bottom */
        .footer-item {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* styling circle icon */
        .footer-icon {
            width: 70px;
            height: 70px;
            border: 3px solid rgba(255, 215, 0, 0.3);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 28px;
            transition: all 0.4s ease;
            color: #FFD700;
            background: rgba(255, 215, 0, 0.05);
        }

        /* styling for footer item heading (whatsapp, email, etc) */
        .footer-item h5 {
            font-size: 17px;
            margin-bottom: 8px;
            font-weight: 700;
            transition: all 0.3s ease;
            color: white;
            letter-spacing: 0.5px;
        }

        /* styling for footer item paragraph */
        .footer-item p {
            margin: 0;
            font-size: 14px;
            transition: all 0.3s ease;
            color: rgba(255, 255, 255, 0.8);
        }

        /* styling for footer item links */
        .footer-item a {
            color: white;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* styling links on hover */
        .footer-item a:hover {
            text-decoration: none;
        }

        /* hover effect for text and icon */
        .footer-item a:hover h5 {
            color: #FFD700;
            transform: translateY(-2px);
        }

        .footer-item a:hover p {
            color: #FFD700;
        }

        .footer-item a:hover .footer-icon {
            border-color: #FFD700;
            background: rgba(255, 215, 0, 0.15);
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 8px 20px rgba(255, 215, 0, 0.3);
        }

        /* styling for footer copyright text */
        .footer {
            text-align: center;
            padding: 20px;
            background: linear-gradient(135deg, #0a0f1a 0%, #151b28 100%);
            width: 100%;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.7);
            border-top: 1px solid rgba(255, 215, 0, 0.1);
        }

        .footer span {
            position: relative;
            z-index: 1;
        }
    </style>

<!-- Footer Info Section -->
<div class="footer-info">
    <div class="container">
        <div class="row">
            <!-- WhatsApp -->
            <div class="col-md-3 col-sm-6">
                <div class="footer-item">
                    <a href="https://wa.me/6287819953555" target="_blank">
                        <div class="footer-icon">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <h5>Whatsapp</h5>
                        <p>+62 878 1995 3555</p>
                    </a>
                </div>
            </div>

            <!-- Email -->
            <div class="col-md-3 col-sm-6">
                <div class="footer-item">
                    <a href="mailto:blessingequipment@gmail.com">
                        <div class="footer-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <h5>Email</h5>
                        <p>blessingequipment@gmail.com</p>
                    </a>
                </div>
            </div>

            <!-- Jam Kerja -->
            <div class="col-md-3 col-sm-6">
                <div class="footer-item">
                    <div class="footer-icon">
                        <i class="bi bi-clock"></i>
                    </div>
                    <h5>Operational Hours</h5>
                    <p>Weekdays 08:00 - 16:00 WIB</p>
                </div>
            </div>

            <!-- Lokasi -->
            <div class="col-md-3 col-sm-6">
                <div class="footer-item">
                    <a href="https://www.google.com/maps/place/Blessing+Equipment/@-7.2815394,112.6886596,17z/data=!3m1!4b1!4m6!3m5!1s0x2dd7fc3d1c5e96fb:0x39e6a4ea1fe8a1b1!8m2!3d-7.2815394!4d112.6886596!16s%2Fg%2F11c209pxhh?entry=ttu&g_ep=EgoyMDI1MTExMi4wIKXMDSoASAFQAw%3D%3D" target="_blank">
                        <div class="footer-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <h5>Location</h5>
                        <p>Blessing Equipment Surabaya</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <span>Copyright 2011-2025 | ©Blessing Equipment Profesional Food Machinery Sparepart. All Rights Reserved</span>
</div>