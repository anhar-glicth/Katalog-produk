<!-- ========================================================
     LUMINA PEARL - GLOBAL AUTH MODAL POP-UP (LOGIN & REGISTER)
     ======================================================== -->
<div id="authModalOverlay" class="auth-modal-overlay" aria-hidden="true" style="display: none;">
    <div class="auth-modal-backdrop" onclick="closeAuthModal()"></div>
    
    <div class="auth-modal-container" role="dialog" aria-modal="true" aria-labelledby="authModalHeading">
        <!-- Mobile Bottom Sheet Handle -->
        <div class="auth-modal-handle"></div>

        <!-- Close Button -->
        <button type="button" class="auth-modal-close" onclick="closeAuthModal()" aria-label="Tutup Pop-Up">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>

        <!-- Modal Brand Header -->
        <div class="auth-modal-header">
            <div class="auth-modal-logo">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2C6.5 2 2 6.5 2 12c0 4 2.5 7.5 6 9 1 .5 2 .8 4 .8s3-.3 4-.8c3.5-1.5 6-5 6-9 0-5.5-4.5-10-10-10z"></path>
                    <circle cx="12" cy="13" r="3.5" fill="#0284c7"></circle>
                </svg>
                <span>LUMINA PEARL</span>
            </div>
            <h3 id="authModalHeading" class="auth-modal-title">Selamat Datang</h3>
            <p id="authModalSubtitle" class="auth-modal-subtitle">Masuk atau daftarkan akun untuk menikmati kemudahan berbelanja.</p>
        </div>

        <!-- Tab Switcher: Masuk vs Daftar -->
        <div class="auth-tabs-nav">
            <button type="button" class="auth-tab-btn active" id="tabBtnLogin" onclick="switchAuthTab('login')">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                    <polyline points="10 17 15 12 10 7"></polyline>
                    <line x1="15" y1="12" x2="3" y2="12"></line>
                </svg>
                <span>Masuk</span>
            </button>
            <button type="button" class="auth-tab-btn" id="tabBtnRegister" onclick="switchAuthTab('register')">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                    <line x1="20" y1="8" x2="20" y2="14"></line>
                    <line x1="23" y1="11" x2="17" y2="11"></line>
                </svg>
                <span>Daftar Baru</span>
            </button>
        </div>

        <!-- Alert Notification Box -->
        <div id="authModalAlert" class="auth-alert-box" style="display: none;"></div>

        <!-- ==============================================
             PANEL 1: FORM LOGIN (MASUK)
             ============================================== -->
        <div id="authPanelLogin" class="auth-tab-panel active">
            <form id="ajaxLoginForm" onsubmit="handleAjaxLogin(event)">
                <input type="hidden" name="ajax" value="1">
                
                <div class="auth-input-group">
                    <label for="loginEmail">Alamat Email</label>
                    <div class="auth-input-wrapper">
                        <svg class="auth-input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <input type="email" id="loginEmail" name="email" class="auth-form-control" placeholder="nama@email.com" required autocomplete="username">
                    </div>
                </div>

                <div class="auth-input-group">
                    <div class="auth-label-row">
                        <label for="loginPassword">Kata Sandi</label>
                    </div>
                    <div class="auth-input-wrapper">
                        <svg class="auth-input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <input type="password" id="loginPassword" name="password" class="auth-form-control" placeholder="••••••••" required autocomplete="current-password">
                        <button type="button" class="auth-eye-btn" onclick="togglePasswordVisibility('loginPassword', this)" title="Lihat Sandi">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="auth-btn-primary" id="loginSubmitBtn">
                    <span>Masuk Sekarang</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </form>

            <!-- Quick Demo Accounts -->
            <div class="auth-demo-box">
                <div class="auth-demo-title">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                    <span>Akun Demo Cepat (1-Klik Isi):</span>
                </div>
                <div class="auth-demo-chips">
                    <button type="button" class="auth-demo-chip" onclick="quickFillLogin('seller@lumina.com', 'seller123')">
                        <span class="chip-role seller">Penjual</span>
                        <span class="chip-email">seller@lumina.com</span>
                    </button>
                    <button type="button" class="auth-demo-chip" onclick="quickFillLogin('buyer@lumina.com', 'buyer123')">
                        <span class="chip-role buyer">Pembeli</span>
                        <span class="chip-email">buyer@lumina.com</span>
                    </button>
                </div>
            </div>

            <div class="auth-switch-text">
                Belum punya akun? <a href="javascript:void(0)" onclick="switchAuthTab('register')">Daftar Akun Baru</a>
            </div>
        </div>

        <!-- ==============================================
             PANEL 2: FORM REGISTER (DAFTAR)
             ============================================== -->
        <div id="authPanelRegister" class="auth-tab-panel" style="display: none;">
            <form id="ajaxRegisterForm" onsubmit="handleAjaxRegister(event)">
                <input type="hidden" name="ajax" value="1">
                <input type="hidden" name="role" id="modalRegisterRole" value="buyer">

                <!-- Role Selector (Pembeli vs Penjual) -->
                <div class="auth-role-selector">
                    <button type="button" class="auth-role-pill active" id="modalRoleBuyerBtn" onclick="switchRegisterRole('buyer')">
                        <span>Pembeli</span>
                        <small>Belanja Koleksi</small>
                    </button>
                    <button type="button" class="auth-role-pill" id="modalRoleSellerBtn" onclick="switchRegisterRole('seller')">
                        <span>Penjual</span>
                        <small>Buka Toko Anda</small>
                    </button>
                </div>

                <!-- Seller-specific Fields -->
                <div id="modalSellerFields" style="display: none;">
                    <div class="auth-input-group">
                        <label for="regStoreName">Nama Toko *</label>
                        <div class="auth-input-wrapper">
                            <svg class="auth-input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            </svg>
                            <input type="text" id="regStoreName" name="store_name" class="auth-form-control" placeholder="Contoh: Galeri Mutiara Bahari">
                        </div>
                    </div>
                </div>

                <div class="auth-input-group">
                    <label for="regName" id="regNameLabel">Nama Lengkap *</label>
                    <div class="auth-input-wrapper">
                        <svg class="auth-input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <input type="text" id="regName" name="name" class="auth-form-control" placeholder="Nama Anda" required autocomplete="name">
                    </div>
                </div>

                <div class="auth-input-group">
                    <label for="regEmail">Alamat Email *</label>
                    <div class="auth-input-wrapper">
                        <svg class="auth-input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <input type="email" id="regEmail" name="email" class="auth-form-control" placeholder="nama@email.com" required autocomplete="email">
                    </div>
                </div>

                <div class="auth-input-row">
                    <div class="auth-input-group">
                        <label for="regPhone">No. WhatsApp / HP</label>
                        <div class="auth-input-wrapper">
                            <input type="tel" id="regPhone" name="phone" class="auth-form-control" placeholder="0812-xxxx-xxxx" autocomplete="tel">
                        </div>
                    </div>
                    <div class="auth-input-group">
                        <label for="regPassword">Kata Sandi (Min 6 Karakter) *</label>
                        <div class="auth-input-wrapper">
                            <input type="password" id="regPassword" name="password" class="auth-form-control" placeholder="••••••••" required minlength="6" autocomplete="new-password">
                        </div>
                    </div>
                </div>

                <button type="submit" class="auth-btn-primary" id="regSubmitBtn">
                    <span id="regSubmitBtnText">Daftar Akun Pembeli</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </form>

            <div class="auth-switch-text">
                Sudah memiliki akun? <a href="javascript:void(0)" onclick="switchAuthTab('login')">Masuk ke Sini</a>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================
     POP-UP STYLES & INTERACTIVE SCRIPT
     ======================================================== -->
<style>
.auth-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 100000;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.28s cubic-bezier(0.16, 1, 0.3, 1);
}

.auth-modal-overlay.active {
    opacity: 1;
    pointer-events: auto;
}

.auth-modal-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(15, 23, 42, 0.65);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

.auth-modal-container {
    position: relative;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    width: 100%;
    max-width: 440px;
    padding: 30px 28px 24px 28px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    color: #0f172a;
    box-sizing: border-box;
    transform: scale(0.94) translateY(10px);
    transition: transform 0.28s cubic-bezier(0.16, 1, 0.3, 1);
    max-height: 90vh;
    overflow-y: auto;
}

.auth-modal-overlay.active .auth-modal-container {
    transform: scale(1) translateY(0);
}

.auth-modal-handle {
    display: none;
    width: 42px;
    height: 4px;
    background: #cbd5e1;
    border-radius: 3px;
    margin: -10px auto 16px auto;
}

.auth-modal-close {
    position: absolute;
    top: 16px;
    right: 16px;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    color: #64748b;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
}

.auth-modal-close:hover {
    background: #fef2f2;
    color: #ef4444;
    border-color: #fecaca;
}

.auth-modal-header {
    text-align: center;
    margin-bottom: 20px;
}

.auth-modal-logo {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #0284c7;
    font-weight: 800;
    font-size: 17px;
    letter-spacing: 0.8px;
    margin-bottom: 8px;
}

.auth-modal-title {
    font-size: 21px;
    font-weight: 700;
    margin: 0 0 4px 0;
    color: #0f172a;
}

.auth-modal-subtitle {
    font-size: 12.5px;
    color: #64748b;
    margin: 0;
    line-height: 1.4;
}

/* Tabs Nav */
.auth-tabs-nav {
    display: grid;
    grid-template-columns: 1fr 1fr;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 4px;
    gap: 4px;
    margin-bottom: 18px;
}

.auth-tab-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 9px 12px;
    background: transparent;
    border: none;
    border-radius: 9px;
    color: #64748b;
    font-size: 13.5px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}

.auth-tab-btn.active {
    background: #ffffff;
    color: #0284c7;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
    font-weight: 700;
}

/* Role Selector */
.auth-role-selector {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    margin-bottom: 14px;
}

.auth-role-pill {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    padding: 8px 10px;
    cursor: pointer;
    text-align: center;
    color: #64748b;
    display: flex;
    flex-direction: column;
    gap: 2px;
    transition: all 0.2s;
}

.auth-role-pill span {
    font-size: 13px;
    font-weight: 700;
}

.auth-role-pill small {
    font-size: 10.5px;
    color: #94a3b8;
}

.auth-role-pill.active {
    border-color: #0284c7;
    background: #f0f9ff;
    color: #0284c7;
}

.auth-role-pill.active small {
    color: #0284c7;
}

/* Form Controls */
.auth-input-group {
    margin-bottom: 14px;
}

.auth-input-group label {
    display: block;
    font-size: 12.5px;
    font-weight: 600;
    color: #334155;
    margin-bottom: 5px;
}

.auth-input-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.auth-input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.auth-input-icon {
    position: absolute;
    left: 12px;
    color: #64748b;
    pointer-events: none;
}

.auth-form-control {
    width: 100%;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 13.5px;
    color: #0f172a;
    box-sizing: border-box;
    transition: all 0.2s;
    outline: none;
    font-family: inherit;
}

.auth-input-wrapper .auth-form-control {
    padding-left: 38px;
}

.auth-form-control:focus {
    border-color: #0284c7;
    box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15);
}

.auth-eye-btn {
    position: absolute;
    right: 10px;
    background: none;
    border: none;
    color: #64748b;
    cursor: pointer;
    padding: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.auth-eye-btn:hover {
    color: #0f172a;
}

/* Primary Submit Button */
.auth-btn-primary {
    width: 100%;
    background: #0284c7;
    color: #ffffff;
    border: none;
    border-radius: 12px;
    padding: 12px;
    font-size: 14.5px;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 8px;
    box-shadow: 0 4px 14px rgba(2, 132, 199, 0.25);
    transition: all 0.2s;
}

.auth-btn-primary:hover {
    background: #0369a1;
    box-shadow: 0 6px 20px rgba(2, 132, 199, 0.35);
    transform: translateY(-1px);
}

.auth-btn-primary:active {
    transform: translateY(1px);
}

.auth-btn-primary:disabled {
    opacity: 0.65;
    cursor: not-allowed;
    transform: none;
}

/* Quick Demo Box */
.auth-demo-box {
    margin-top: 16px;
    background: #f8fafc;
    border: 1px dashed #cbd5e1;
    border-radius: 10px;
    padding: 10px 12px;
}

.auth-demo-title {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 11px;
    font-weight: 700;
    color: #0284c7;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.auth-demo-chips {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 6px;
}

.auth-demo-chip {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 6px 8px;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 2px;
    text-align: left;
    transition: all 0.2s;
}

.auth-demo-chip:hover {
    border-color: #0284c7;
    background: #f0f9ff;
}

.chip-role {
    font-size: 10px;
    font-weight: 700;
    padding: 1px 5px;
    border-radius: 4px;
}

.chip-role.seller {
    background: #f0fdf4;
    color: #166534;
}

.chip-role.buyer {
    background: #f0f9ff;
    color: #0369a1;
}

.chip-email {
    font-size: 11px;
    color: #64748b;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 100%;
}

.auth-switch-text {
    text-align: center;
    margin-top: 14px;
    font-size: 12.5px;
    color: #64748b;
}

.auth-switch-text a {
    color: #0284c7;
    font-weight: 600;
    text-decoration: none;
}

.auth-switch-text a:hover {
    text-decoration: underline;
}

/* Alert Notification */
.auth-alert-box {
    padding: 10px 14px;
    border-radius: 10px;
    font-size: 12.5px;
    line-height: 1.4;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.auth-alert-box.error {
    background: rgba(239, 68, 68, 0.15);
    border: 1px solid #ef4444;
    color: #fca5a5;
}

.auth-alert-box.success {
    background: rgba(16, 185, 129, 0.15);
    border: 1px solid #10b981;
    color: #6ee7b7;
}

.auth-alert-box.info {
    background: rgba(56, 189, 248, 0.15);
    border: 1px solid #38bdf8;
    color: #7dd3fc;
}

/* ==============================================
   NATIVE ANDROID BOTTOM SHEET RESPONSIVENESS
   ============================================== */
@media screen and (max-width: 768px) {
    .auth-modal-overlay {
        padding: 0 !important;
        align-items: flex-end !important;
    }

    .auth-modal-container {
        max-width: 100vw !important;
        width: 100vw !important;
        border-radius: 24px 24px 0 0 !important;
        border-bottom: none !important;
        padding: 16px 20px 24px 20px !important;
        max-height: 85vh !important;
        transform: translateY(100%) !important;
        transition: transform 0.32s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .auth-modal-overlay.active .auth-modal-container {
        transform: translateY(0) !important;
    }

    .auth-modal-handle {
        display: block !important;
    }

    .auth-modal-close {
        top: 14px !important;
        right: 14px !important;
    }

    .auth-modal-title {
        font-size: 19px !important;
    }

    .auth-input-row {
        grid-template-columns: 1fr !important;
        gap: 0 !important;
    }

    .auth-tab-btn.active {
        background: #0284c7 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(2, 132, 199, 0.35) !important;
    }

    .auth-btn-primary {
        background: linear-gradient(135deg, #0b3c5d, #0284c7) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 14px rgba(2, 132, 199, 0.35) !important;
    }

    .auth-role-pill.active {
        border-color: #0284c7 !important;
        background: rgba(2, 132, 199, 0.12) !important;
        color: #0284c7 !important;
    }

    .auth-role-pill.active small {
        color: #0284c7 !important;
    }

    .auth-form-control:focus {
        border-color: #0284c7 !important;
        box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.2) !important;
    }
}
</style>

<script>
// ========================================================
// AUTH MODAL POP-UP LOGIC (AJAX LOGIN & REGISTER)
// ========================================================
function openAuthModal(tab = 'login', notice = '') {
    const overlay = document.getElementById('authModalOverlay');
    if (!overlay) return;

    overlay.style.display = 'flex';
    // Trigger reflow for smooth animation
    void overlay.offsetWidth;
    overlay.classList.add('active');
    overlay.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';

    switchAuthTab(tab);

    const alertBox = document.getElementById('authModalAlert');
    if (notice) {
        alertBox.className = 'auth-alert-box info';
        alertBox.innerHTML = 'ℹ️ ' + notice;
        alertBox.style.display = 'flex';
    } else {
        alertBox.style.display = 'none';
        alertBox.innerHTML = '';
    }
}

function closeAuthModal() {
    const overlay = document.getElementById('authModalOverlay');
    if (!overlay) return;

    overlay.classList.remove('active');
    overlay.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    setTimeout(() => {
        if (!overlay.classList.contains('active')) {
            overlay.style.display = 'none';
        }
    }, 280);
}

function switchAuthTab(tab) {
    const btnLogin = document.getElementById('tabBtnLogin');
    const btnReg = document.getElementById('tabBtnRegister');
    const panelLogin = document.getElementById('authPanelLogin');
    const panelReg = document.getElementById('authPanelRegister');
    const title = document.getElementById('authModalHeading');
    const sub = document.getElementById('authModalSubtitle');
    const alertBox = document.getElementById('authModalAlert');

    if (alertBox) alertBox.style.display = 'none';

    if (tab === 'register') {
        btnLogin.classList.remove('active');
        btnReg.classList.add('active');
        panelLogin.style.display = 'none';
        panelReg.style.display = 'block';
        title.innerText = 'Daftar Akun Baru';
        sub.innerText = 'Bergabunglah untuk memesan produk eksklusif atau buka toko perhiasan.';
    } else {
        btnReg.classList.remove('active');
        btnLogin.classList.add('active');
        panelReg.style.display = 'none';
        panelLogin.style.display = 'block';
        title.innerText = 'Selamat Datang';
        sub.innerText = 'Masuk sebagai Penjual atau Pembeli untuk melanjutkan.';
    }
}

function switchRegisterRole(role) {
    document.getElementById('modalRegisterRole').value = role;
    const btnBuyer = document.getElementById('modalRoleBuyerBtn');
    const btnSeller = document.getElementById('modalRoleSellerBtn');
    const sellerFields = document.getElementById('modalSellerFields');
    const submitBtnText = document.getElementById('regSubmitBtnText');
    const nameLabel = document.getElementById('regNameLabel');

    if (role === 'seller') {
        btnSeller.classList.add('active');
        btnBuyer.classList.remove('active');
        sellerFields.style.display = 'block';
        submitBtnText.innerText = 'Buka Toko Sekarang';
        nameLabel.innerText = 'Nama Pemilik Toko *';
    } else {
        btnBuyer.classList.add('active');
        btnSeller.classList.remove('active');
        sellerFields.style.display = 'none';
        submitBtnText.innerText = 'Daftar Akun Pembeli';
        nameLabel.innerText = 'Nama Lengkap *';
    }
}

function quickFillLogin(email, password) {
    document.getElementById('loginEmail').value = email;
    document.getElementById('loginPassword').value = password;
    const alertBox = document.getElementById('authModalAlert');
    alertBox.className = 'auth-alert-box info';
    alertBox.innerHTML = 'Kredensial demo otomatis terisi. Silakan klik <strong>Masuk Sekarang</strong>!';
    alertBox.style.display = 'flex';
}

function togglePasswordVisibility(inputId, btn) {
    const input = document.getElementById(inputId);
    if (!input) return;
    if (input.type === 'password') {
        input.type = 'text';
        btn.style.color = '#0284c7';
    } else {
        input.type = 'password';
        btn.style.color = '#64748b';
    }
}

// Handle AJAX Login
function handleAjaxLogin(e) {
    e.preventDefault();
    const form = document.getElementById('ajaxLoginForm');
    const submitBtn = document.getElementById('loginSubmitBtn');
    const alertBox = document.getElementById('authModalAlert');

    const originalBtnHtml = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span>Memverifikasi...</span>';
    alertBox.style.display = 'none';

    const formData = new FormData(form);

    fetch((window.BASEURL || '') + 'auth/login', {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alertBox.className = 'auth-alert-box success';
            alertBox.innerHTML = (data.message || 'Login berhasil! Mengalihkan...');
            alertBox.style.display = 'flex';
            setTimeout(() => {
                if (data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    window.location.reload();
                }
            }, 800);
        } else {
            alertBox.className = 'auth-alert-box error';
            alertBox.innerHTML = (data.message || 'Gagal masuk. Periksa kembali email dan kata sandi.');
            alertBox.style.display = 'flex';
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnHtml;
        }
    })
    .catch(err => {
        console.error(err);
        alertBox.className = 'auth-alert-box error';
        alertBox.innerHTML = 'Terjadi gangguan koneksi. Silakan coba lagi.';
        alertBox.style.display = 'flex';
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnHtml;
    });
}

// Handle AJAX Register
function handleAjaxRegister(e) {
    e.preventDefault();
    const form = document.getElementById('ajaxRegisterForm');
    const submitBtn = document.getElementById('regSubmitBtn');
    const alertBox = document.getElementById('authModalAlert');

    const originalBtnHtml = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span>Mendaftarkan...</span>';
    alertBox.style.display = 'none';

    const formData = new FormData(form);

    fetch((window.BASEURL || '') + 'auth/register', {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alertBox.className = 'auth-alert-box success';
            alertBox.innerHTML = (data.message || 'Pendaftaran berhasil!');
            alertBox.style.display = 'flex';
            setTimeout(() => {
                if (data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    window.location.reload();
                }
            }, 900);
        } else {
            alertBox.className = 'auth-alert-box error';
            alertBox.innerHTML = (data.message || 'Pendaftaran gagal. Periksa kembali data Anda.');
            alertBox.style.display = 'flex';
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnHtml;
        }
    })
    .catch(err => {
        console.error(err);
        alertBox.className = 'auth-alert-box error';
        alertBox.innerHTML = 'Terjadi gangguan koneksi. Silakan coba lagi.';
        alertBox.style.display = 'flex';
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnHtml;
    });
}

// Keyboard ESC listener
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeAuthModal();
    }
});

// Auto-open modal if URL contains ?auth=login or ?auth=register
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const authAction = urlParams.get('auth');
    if (authAction === 'login') {
        openAuthModal('login');
    } else if (authAction === 'register') {
        openAuthModal('register');
        if (urlParams.get('role') === 'seller') {
            switchRegisterRole('seller');
        }
    }
});
</script>
