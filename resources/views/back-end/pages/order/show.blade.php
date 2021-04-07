<div id="modal-show-order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

        <!-- Modal Header -->
        <!-- <div class="modal-header" style="display: flex">
          <h4 class="modal-title">Xem chi tiết đơn hàng</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> -->

              <!-- Modal body -->
        <div class="modal-body" id="table-order">
          <h5 class="modal-title">Thông tin đặt hàng</h5>
          <table class="table">
            <thead>
              <tr>     
                <th>Tên khách hàng</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Tổng tiền</th>
                <th>Ghi chú</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td id="name"></td>
                <td id="address"></td>
                <td id="phone"></td>
                <td id="money"></td>
                <td id="message"></td>
              </tr>
            </tbody>
          </table>
        </div>
              <!-- Modal body -->
        <div class="modal-body" id="table-account">
        <h5 class="modal-title">Thông tin tài khoản</h5>
          <table class="table">
            <thead>
              <tr>
                <th>Mã tài khoản</th>
                <th>Tên tài khoản</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td id="idUser"></td>
                <td id="nameUser"></td>
                <td id="emailUser"></td>
              </tr>
            </tbody>
          </table>
        </div>


        <div class="modal-body" id="table-product">
        <h5 class="modal-title">Thông tin sản phẩm đã đặt</h5>
          <table class="table">
            <thead>
              <tr>
                <th>Tên sản phẩm</th>
                <th class="image">Ảnh sản phẩm</th>
                <th class="qtyStock">Số lượng trong kho</th>
                <th>Số lượng</th>
                <th>Giá đặt hàng</th>
                <th>Tổng</th>
              </tr>
            </thead>
            <tbody id="product">
                <!-- render product -->
            </tbody>
          </table>
        </div>
            <!-- Modal footer -->
          <div class="modal-footer">
          <select class="form-select form-select-sm select-form-order btn btn-sm btn-outline-secondary" style="margin-right: auto">
            <option value="0">Chưa xử lý</option>
            <option value="1">Đã xử lý</option>
            <option value="2">Hủy đơn hàng</option>
          </select>
            <form action="{{route('printOrder')}}" method="POST" id="formPdf" class="d-none">
              @csrf
                <input type="hidden" value="" name="tableAccount" id="tblAcc">
                <input type="hidden" value="" name="tableProduct" id="tblPro">
                <input type="hidden" value="" name="tableOrder" id="tblOrd">
                <button type="submit" class="btn btn-info" id="printOrder">In đơn hàng</button>
            </form>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
          </div>
        </div>
    </div>
</div>
