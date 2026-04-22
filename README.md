# Salut - Chia sẻ Pháp ngữ

Website multi-page cho trung tâm tiếng Pháp **Salut** tại Hà Nội.
Lấy cảm hứng từ banner fanpage: palette lavender + vàng + cream, handwritten Caveat/Pacifico, vibe "Oui Oui Baguette!".

🔗 **Live:** https://salut-french-website.vercel.app _(sau khi deploy)_
📘 **Fanpage:** [facebook.com/Tiengphapsalut](https://www.facebook.com/Tiengphapsalut)
🛠️ **Stack:** Eleventy (11ty) · Nunjucks · Vanilla CSS/JS · Vercel

## Cấu trúc

```
.
├── src/
│   ├── _includes/
│   │   ├── base.njk              Layout chính (shared header/footer)
│   │   └── partials/
│   │       ├── header.njk         Navigation
│   │       ├── footer.njk         Footer 4 cột
│   │       ├── cta-band.njk       CTA band trước footer
│   │       └── schedule-table.njk Bảng lịch (shared giữa nhiều trang)
│   ├── _data/
│   │   ├── site.json              Config site: SĐT, email, Formspree ID, nav
│   │   ├── courses.json           6 khoá học + outcomes + curriculum
│   │   ├── schedule.json          Lịch khai giảng
│   │   ├── testimonials.json      Cảm nhận học viên
│   │   └── posts.json             Bài blog
│   ├── assets/
│   │   ├── css/main.css           ~1500 dòng CSS
│   │   ├── js/main.js             Menu, smooth scroll, reveal, form AJAX
│   │   └── images/
│   ├── index.njk                  Trang chủ
│   ├── khoa-hoc/
│   │   ├── index.njk              List 6 khoá học (/khoa-hoc/)
│   │   └── course.njk             Paginated → 6 trang chi tiết khoá
│   ├── lich-khai-giang.njk        Lịch khai giảng đầy đủ
│   ├── ve-chung-toi.njk           Về Salut + đội ngũ + giá trị
│   ├── blog/
│   │   ├── index.njk              List bài viết
│   │   └── post.njk               Paginated → 3 trang bài blog
│   ├── lien-he.njk                Form đăng ký + thông tin + Google Maps
│   └── 404.njk                    Trang lỗi
├── _site/                         Build output (gitignored)
├── wordpress/                     WordPress theme phiên bản PHP (nếu cần CMS)
├── .eleventy.js                   Config Eleventy
├── package.json
└── vercel.json
```

## Chạy local

```bash
npm install           # chỉ chạy 1 lần đầu
npm run dev           # dev server + watch + live reload tại http://localhost:3000
npm run build         # build production ra _site/
npm run clean         # xoá _site/
```

Mọi thay đổi trong `src/` sẽ tự rebuild + reload browser.

## Deploy lên Vercel

### Cách 1 — Auto deploy từ GitHub (khuyến nghị)

1. Truy cập [vercel.com/new](https://vercel.com/new)
2. Import repo `salut-french-website`
3. Vercel tự detect Eleventy và set:
   - Build Command: `npm run build`
   - Output Directory: `_site`
4. Click **Deploy**

Mỗi lần `git push` → Vercel tự rebuild.

### Cách 2 — Qua Vercel CLI

```bash
npm i -g vercel
vercel login
vercel --prod
```

### Domain riêng

`Settings → Domains → Add` → nhập `tiengphapsalut.vn` → làm theo hướng dẫn trỏ DNS.

## Form đăng ký tư vấn — kích hoạt Formspree (1 phút)

1. Đăng ký tại [formspree.io](https://formspree.io) bằng email muốn nhận thông báo
2. **+ New Form** → Name: "Salut Website" → Create
3. Copy form ID (8 ký tự, trong URL `formspree.io/f/xvojpnrq`)
4. Mở [`src/_data/site.json`](src/_data/site.json), thay `YOUR_FORMSPREE_ID` bằng ID
5. Commit + push → Vercel tự redeploy

**Gói miễn phí:** 50 submissions/tháng. Có sẵn AJAX submit, honeypot, GA events.

## Cập nhật nội dung

### Thêm khoá học mới
Sửa [`src/_data/courses.json`](src/_data/courses.json) — thêm 1 object mới. Eleventy sẽ tự tạo trang `/khoa-hoc/<slug>/`.

### Cập nhật lịch khai giảng
Sửa [`src/_data/schedule.json`](src/_data/schedule.json) — bảng lịch ở mọi trang sẽ tự cập nhật.

### Viết bài blog
Thêm vào [`src/_data/posts.json`](src/_data/posts.json). Content support HTML (escape quotes). Tự tạo trang `/blog/<slug>/`.

### Đổi SĐT / email / Facebook
Sửa [`src/_data/site.json`](src/_data/site.json) — áp dụng cho mọi trang.

### Đổi menu navigation
Sửa `nav` array trong [`src/_data/site.json`](src/_data/site.json).

## Palette màu

Sửa `:root` trong [`src/assets/css/main.css`](src/assets/css/main.css) (dòng ~8):
- Lavender 300 `#B8A7E0` — background hero chính
- Lavender 600 `#6B5B95` — button primary
- Yellow `#FFE066` — accent
- Cream `#FFF9F0` — background chính

## Fonts

- **Poppins** — body + headings
- **Caveat** — handwritten accent
- **Pacifico** — logo "Salut"

## Trang đã có

| URL | Trang | Nội dung |
|-----|-------|----------|
| `/` | Trang chủ | Hero + preview mọi section |
| `/khoa-hoc/` | Danh sách khoá học | 6 khoá |
| `/khoa-hoc/<slug>/` | Chi tiết từng khoá | Description + outcomes + curriculum + lịch khai giảng liên quan |
| `/lich-khai-giang/` | Lịch đầy đủ | Bảng 8 lớp + thông tin |
| `/ve-chung-toi/` | Về Salut | Story + 4 giá trị + đội ngũ 3 GV + số liệu |
| `/blog/` | Blog | List bài viết |
| `/blog/<slug>/` | Chi tiết bài | Content + bài liên quan |
| `/lien-he/` | Liên hệ | Form Formspree + info + Google Maps |
| `/404.html` | Trang lỗi | |

## Phiên bản WordPress (`wordpress/`)

Nếu sau này cần CMS backend (admin tự edit không cần code):
- WordPress theme riêng với Custom Post Types
- Hỗ trợ Contact Form 7
- Xem [`wordpress/cf7-template.txt`](wordpress/cf7-template.txt) để setup CF7

**Vercel không host được WordPress** — cần hosting PHP (Hostinger, SiteGround, Cloudways).

---

À bientôt! 🥐

_Made with 💜 in Hanoi_
