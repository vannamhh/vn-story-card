# VN Story Card

VN Story Card là một plugin WordPress tùy chỉnh được thiết kế riêng cho theme **Flatsome**. Nó cung cấp các element cho **UX Builder** giúp hiển thị các "câu chuyện thành công" hoặc bài viết nổi bật dưới dạng thẻ (card) với bố cục chuyên nghiệp và hỗ trợ slider.

## Tính năng chính

- **Tích hợp UX Builder**: Thêm trực tiếp element từ trình dựng trang của Flatsome.
- **Chọn bài viết thông minh**: Sử dụng tính năng `postSelect` (dropdown search) để chọn bài viết có sẵn.
- **Tự động hóa & Tùy chỉnh**: 
    - Tự động lấy Tiêu đề, Ảnh đại diện và Link từ bài viết đã chọn.
    - Cho phép ghi đè hoàn toàn các thông tin này (Tiêu đề tùy chỉnh, Ảnh tùy chỉnh, Link tùy chỉnh).
- **Slider Wrapper**: Element `VN Story Cards Slider` cho phép bọc nhiều card vào một slider sử dụng Flickity (native Flatsome JS).
- **Thiết kế tối ưu**: Giao diện 2 cột (Text & Button | Image) chuẩn SEO và đáp ứng tốt trên các thiết bị.

## Cấu trúc Shortcode

### 1. Slider Wrapper
```shortcode
[vn_story_cards timer="4000" nav_style="simple" bullets="false"]
    [vn_story_card post_id="123"]
    [vn_story_card post_id="456" title="Tiêu đề tùy chỉnh"]
[/vn_story_cards]
```

### 2. Single Card
```shortcode
[vn_story_card post_id="123" button_text="Xem chi tiết" link="https://example.com"]
```

## Cài đặt

1. Tải thư mục `vn-story-card` lên thư mục `/wp-content/plugins/`.
2. Kích hoạt plugin trong giao diện Quản lý Plugin của WordPress.
3. Mở UX Builder trên bất kỳ trang nào, tìm kiếm element "VN Story Card" trong danh mục "Content".

## Yêu cầu

- **Theme**: Flatsome (3.10+)
- **PHP**: 7.4+
- **WordPress**: 5.8+

## Tác giả

- **Author**: Van Nam
- **Website**: [ztavi.com](https://ztavi.com)
