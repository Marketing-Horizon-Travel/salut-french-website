# Salut - Chia sẻ Pháp ngữ

Website cho trung tâm tiếng Pháp **Salut** tại Hà Nội.
Lấy cảm hứng từ banner fanpage: palette lavender + vàng + cream, handwritten Caveat/Pacifico, vibe "Oui Oui Baguette!".

🔗 **Live:** https://salut-french-website.vercel.app _(sẽ có sau khi deploy)_
📘 **Fanpage:** [facebook.com/Tiengphapsalut](https://www.facebook.com/Tiengphapsalut)

## Cấu trúc repo

```
.
├── index.html          Trang chính (static, deploy lên Vercel)
├── assets/
│   ├── css/main.css    CSS toàn bộ (~1300 dòng)
│   └── js/main.js      JS vanilla: menu, smooth scroll, reveal, form
├── vercel.json         Cấu hình Vercel (cache, headers, redirects)
├── wordpress/          WordPress theme phiên bản PHP (dùng riêng nếu muốn)
└── README.md
```

## Xem thử local

Mở trực tiếp `index.html` trong browser — không cần build tool, không cần server.

Hoặc dùng live server:
```bash
npx serve .
# hoặc
python -m http.server 8000
```

## Deploy lên Vercel

### Cách 1 — Qua Vercel Dashboard (đơn giản nhất)

1. Truy cập [vercel.com/new](https://vercel.com/new)
2. Import repo `salut-french-website` từ GitHub
3. Framework Preset: **Other**
4. Root Directory: để trống
5. Build Command: để trống
6. Output Directory: để trống
7. Nhấn **Deploy** — sau ~30 giây, site live

### Cách 2 — Qua Vercel CLI

```bash
npm i -g vercel
vercel login
vercel --prod
```

### Tuỳ chỉnh domain

- Vercel cho sẵn domain `*.vercel.app` miễn phí
- Muốn dùng domain riêng (vd `tiengphapsalut.vn`): `Settings → Domains → Add`, trỏ DNS theo hướng dẫn

## Form đăng ký tư vấn — Kích hoạt Formspree (1 phút)

Form đã được tích hợp sẵn Formspree. Chỉ cần:

1. **Đăng ký miễn phí** tại [formspree.io](https://formspree.io) (dùng email `contact@tiengphapsalut.vn` hoặc email bạn muốn nhận thông báo)
2. Click **+ New Form** → đặt tên (vd: "Salut Website") → **Create Form**
3. Copy form ID — nó có dạng `xvojpnrq` (8 ký tự), nằm trong URL `https://formspree.io/f/xvojpnrq`
4. Mở [index.html](index.html), tìm:
   ```html
   action="https://formspree.io/f/YOUR_FORMSPREE_ID"
   ```
   Thay `YOUR_FORMSPREE_ID` bằng ID vừa copy.
5. Commit + push — Vercel tự redeploy:
   ```bash
   git add index.html
   git commit -m "Enable Formspree endpoint"
   git push
   ```

**Gói miễn phí:** 50 submissions/tháng. Nâng cấp Gold ($10/tháng) = không giới hạn + tắt branding + webhook.

**Tính năng đã có sẵn:**
- ✅ AJAX submit (không reload trang)
- ✅ Loading state, success/error message
- ✅ Honeypot `_gotcha` chống bot
- ✅ Tự động gửi email về địa chỉ bạn đăng ký Formspree với subject "[Salut] Đăng ký tư vấn mới từ website"
- ✅ Track event `lead_submit` cho Google Analytics (nếu có cài)
- ✅ Track Facebook Pixel `Lead` event (nếu có cài)

### Thay thế khác (nếu không muốn Formspree)

| Dịch vụ | Free tier | Lưu ý |
|---|---|---|
| [Getform](https://getform.io) | 50/tháng | Tương tự Formspree |
| [Web3Forms](https://web3forms.com) | Unlimited | Cần access key thay form ID |
| [FormSubmit](https://formsubmit.co) | Unlimited | Đơn giản nhất, chỉ cần email |
| [Google Forms](https://forms.google.com) | Unlimited | Cần code tuỳ biến thêm |

Chỉ cần đổi URL trong `action="..."` — JS đã tương thích với Formspree/Getform/Web3Forms.

## Tuỳ biến màu / font / text

### Đổi màu chủ đạo
Sửa `:root` trong [assets/css/main.css](assets/css/main.css) (dòng ~8):
```css
--lavender-300: #B8A7E0;  /* Hero background */
--lavender-600: #6B5B95;  /* Primary button */
--yellow: #FFE066;         /* Accent */
```

### Đổi thông tin liên hệ
Tìm & thay trong `index.html`:
- SĐT: `+84 827 030 018`
- Email: `contact@tiengphapsalut.vn`
- Địa chỉ: `Hà Nội, Việt Nam`
- Facebook URL: `https://www.facebook.com/Tiengphapsalut`

### Thêm Google Analytics
Dán script GA4 ngay trước `</head>` trong `index.html`.

## Các section có trong trang

1. **Hero** — lavender + Eiffel SVG, máy bay giấy, ngôi sao
2. **Về Salut** — 3 điểm nổi bật + sticker "Bonjour!" / "à bientôt"
3. **Khoá học** — 6 khoá (TCF Canada, DELF, TCF TP, Ngữ pháp, A1, Giao tiếp)
4. **Lịch khai giảng** — bảng 6 lớp sắp khai giảng với slot badge
5. **Vì sao chọn Salut** — 4 feature cards (cam kết, lớp nhỏ, lịch linh hoạt, café Pháp)
6. **Học viên nói gì** — 4 testimonial cards
7. **Blog Salut** — 3 bài viết mới nhất
8. **Đăng ký tư vấn** — form liên hệ + info card
9. **CTA band** — "Oui Oui Baguette!"
10. **Footer** — 4 cột + newsletter

## Phiên bản WordPress (`wordpress/`)

Nếu về sau bạn muốn có:
- Admin panel quản lý khoá học / lịch học / testimonial
- Blog CMS đầy đủ
- Lưu đơn đăng ký vào database

Copy thư mục `wordpress/` vào `wp-content/themes/salut-theme/` trên host WordPress riêng. Xem [wordpress/](wordpress/) để biết chi tiết cài đặt (sẽ viết README riêng khi cần).

Vercel KHÔNG host được WordPress — cần hosting PHP riêng (Hostinger, SiteGround, Cloudways, Kinsta…).

## Roadmap

- [ ] Tích hợp form thật với Formspree
- [ ] Thêm trang Giảng viên chi tiết
- [ ] Thêm landing page riêng cho chiến dịch DELF
- [ ] Chuyển sang Next.js nếu cần backend (thanh toán, đăng nhập học viên)
- [ ] Multi-language: Vietnamese / English / Français

---

À bientôt! 🥐

_Made with 💜 in Hanoi_
