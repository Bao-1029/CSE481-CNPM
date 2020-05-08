<main class="main">
    <div class="main__top">
        <h2 class="main__title">Danh sách đường dây nóng của các bệnh viện</h2>
        <div class="main__search">
            <form>
                <input type="text" name="search" id="search" placeholder="Tên bệnh viện hoặc sđt">
                <i>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" viewBox="0 0 15 15">
                        <defs>
                            <clipPath id="clip-path">
                                <rect id="Rectangle_33" data-name="Rectangle 33" width="15" height="15" fill="#fff" />
                            </clipPath>
                        </defs>
                        <g id="Mask_Group_1" data-name="Mask Group 1" clip-path="url(#clip-path)">
                            <path id="icons8-search_iOS_Glyph" data-name="icons8-search_iOS Glyph" d="M11.574,5.621a5.953,5.953,0,1,0,3.763,10.558l3.554,3.554a.6.6,0,1,0,.842-.842l-3.554-3.554a5.946,5.946,0,0,0-4.605-9.716Zm0,1.191a4.762,4.762,0,1,1-4.762,4.762A4.753,4.753,0,0,1,11.574,6.812Z" transform="translate(-5.621 -5.621)" fill="rgba(121,117,225,0.7)" />
                        </g>
                    </svg>
                </i>
            </form>
        </div>
        <button class="main__add">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 16 16">
                <defs>
                    <clipPath id="clip-path2">
                        <rect id="Rectangle_66" data-name="Rectangle 66" width="16" height="16" fill="#fff" stroke="#707070" stroke-width="1" />
                    </clipPath>
                </defs>
                <g id="add" clip-path="url(#clip-path2)">
                    <path id="Plus_iOS_Glyph_100" data-name="Plus_iOS Glyph_100" d="M10.968,2.969a1.332,1.332,0,0,0-1.312,1.35V9.646H4.328a1.332,1.332,0,1,0,0,2.664H9.655v5.327a1.332,1.332,0,1,0,2.664,0V12.31h5.327a1.332,1.332,0,1,0,0-2.664H12.319V4.319a1.332,1.332,0,0,0-1.351-1.35Z" transform="translate(-2.987 -2.969)" fill="#7975e1" />
                </g>
            </svg>

            <span class="main__text-add">Thêm</span>
        </button>
    </div>
    <div class="main__table">
        <table>
            <thead>
                <tr>
                    <th>Tên bệnh viện</th>
                    <th>Số điện thoại</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</main>