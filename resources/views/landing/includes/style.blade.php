    <link rel="stylesheet" href="{{ asset('/landing') }}/assets/css/plugins.css">
    <link rel="stylesheet" href="{{ asset('/landing') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('/landing') }}/assets/css/colors/aggi.css">
    <link rel="preload" href="{{ asset('/landing') }}/assets/css/fonts/urbanist.css" as="style" onload="this.rel='stylesheet'">
    <style>
        .custom-divider {
            width: 120px;
        }

        .nav-link:hover {
            color: #000000 !important;
        }

        .remove-ahli-waris {
            cursor: pointer;
        }

        @media (max-width: 576px) {

            /* Small devices (576px and below) */
            .nav-link {
                font-size: 12px;
            }

            .custom-divider {
                width: 80px;
            }
        }

        @media (min-width: 577px) and (max-width: 768px) {

            /* Medium devices (577px to 768px) */
            .nav-link {
                font-size: 14px;
            }

            .custom-divider {
                width: 100px;
            }
        }

        /* Add more media queries as needed for larger screen sizes */
    </style>
