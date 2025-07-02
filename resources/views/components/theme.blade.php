<script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'nigeria-green': '#008751',
                        'nigeria-green-light': '#00b96b',
                        'nigeria-white': '#FFFFFF',
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'bounce-slow': 'bounce 2s infinite'
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #008751 0%, #00b96b 100%);
        }
        .code-bg {
            background: #1a1a1a;
        }
        .glow {
            box-shadow: 0 0 20px rgba(0, 135, 81, 0.3);
        }
        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .slide-in {
            animation: slideIn 0.8s ease-out;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .wave-shape {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }
        .wave-shape svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 150px;
        }
        .wave-shape .shape-fill {
            fill: #FFFFFF;
        }
        .tab-active {
            border-bottom: 3px solid #008751;
            color: #008751;
            font-weight: 600;
        }
        .response-tab {
            transition: all 0.3s ease;
        }
        .response-tab:hover {
            background-color: #f0fdf4;
        }
        .copy-btn {
            transition: all 0.2s ease;
        }
        .copy-btn:hover {
            transform: scale(1.05);
            background-color: #008751;
        }
        .copy-btn.copied {
            background-color: #10b981;
        }
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        .mobile-menu.open {
            max-height: 500px;
        }
    </style>