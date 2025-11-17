    <style>
        .footer-info {
            background: linear-gradient(135deg, #0a0f1a 0%, #151b28 100%);
            padding: 30px 0;
            color: white;
            width: 100%;
            margin-top: 50px;
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
            width: 60px;
            height: 60px;
            border: 2px solid white;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            font-size: 24px;
            transition: all 0.3s ease;
            color: white;
        }

        /* styling for footer item heading (whatsapp, email, etc) */
        .footer-item h5 {
            font-size: 16px;
            margin-bottom: 5px;
            font-weight: bold;
            transition: color 0.3s ease;
            color: white;
        }

        /* styling for footer item paragraph */
        .footer-item p {
            margin: 0;
            font-size: 14px;
            transition: color 0.3s ease;
            color: white;
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
        .footer-item a:hover h5,
        .footer-item a:hover p {
            color: #FFD700;
        }

        .footer-item a:hover .footer-icon {
            border-color: #FFD700;
            color: #FFD700;
        }

        /* styling for footer copyright text */
        .footer {
            text-align: center;
            padding: 15px;
            background-color: #f1f1f1;
            width: 100%;
            font-size: 12px;
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