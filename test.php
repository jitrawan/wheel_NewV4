<form method="post" id="order_frm" class="setup_frm" autocomplete="off" action="index.php/inventory/model/sell/submit">
   <input type="hidden" name="_module" value="inventory-outward"><input type="hidden" name="_status" value="6"><input type="hidden" name="token" id="token" value="63bac1dcec5b2fff9169a1329c4d591f">
   <fieldset>
      <legend><span class="icon-profile">รายละเอียดของ ลูกค้า</span></legend>
      <div class="item">
         <div class="input-groups">
            <div class="width90"><label for="customer">ลูกค้า<span class="tablet"> (F2)</span></label><span class="g-input icon-customer"><input id="customer" placeholder="กรอกบางส่วนของ ชื่อบริษัท, ชื่อ, อีเมล, โทรศัพท์ เพื่อค้นหา" title="ลูกค้า" autofocus="" type="text" name="customer" value="" class=""></span></div>
            <div class="width10"><label for="add_customer">&nbsp;</label><span class="g-input"><button id="add_customer" class="green button wide center icon-register" type="button" name="add_customer" title="&nbsp;" tabindex="0" style="cursor: pointer;"><span class="mobile">เพิ่ม ลูกค้า</span></button></span></div>
         </div>
      </div>
   </fieldset>
   <fieldset>
      <legend><span class="icon-cart">รายละเอียดการทำธุรกรรม</span></legend>
      <div class="item">
         <div class="input-groups">
            <div class="width50"><label for="order_no">เลขที่ใบสั่งซื้อ</label><span class="g-input icon-number"><input id="order_no" placeholder="เว้นว่างไว้เพื่อสร้างโดยอัตโนมัติ" type="text" name="order_no" value="" title="เลขที่ใบสั่งซื้อ"></span></div>
            <div class="width50">
               <label for="order_date">วันที่ทำรายการ</label>
               <span class="g-input icon-calendar">
                  <div tabindex="0" class="input-gcalendar" title="วันที่ทำรายการ" style="cursor: pointer;">
                     <div class="placeholder" style="position: absolute; display: none;"></div>
                     <div>17 ธ.ค. 2561</div>
                  </div>
                  <input id="order_date" type="hidden" name="order_date" value="2018-12-17" title="วันที่ทำรายการ">
               </span>
            </div>
         </div>
      </div>
      <div class="item">
         <div class="input-groups">
            <div class="width20"><label for="product_quantity">จำนวน</label><span class="g-input icon-number"><input name="product_quantity" id="product_quantity" type="text" title="จำนวน" size="20" class="ginput" data-keyboard="1234567890"></span></div>
            <div class="width70"><label for="product_no">รหัสสินค้า/บาร์โค้ด<span class="tablet"> (F4)</span></label><span class="g-input icon-addtocart"><input id="product_no" title="สินค้า" placeholder="กรอกบางส่วนของ รหัสสินค้า, ชื่อสินค้า เพื่อค้นหา" type="text" name="product_no"></span></div>
            <div class="width10"><label for="add_product">&nbsp;</label><span class="g-input"><button id="add_product" class="magenta button wide center icon-new" type="button" name="add_product" title="&nbsp;" tabindex="0" style="cursor: pointer;"><span class="mobile">เพิ่ม สินค้า</span><span class="tablet"> (F7)</span></button></span></div>
         </div>
      </div>
      <div class="item">
         <table class="fullwidth">
            <thead>
               <tr>
                  <th class="center">จำนวน</th>
                  <th>รายละเอียด</th>
                  <th class="center">หน่วยละ</th>
                  <th class="center"></th>
                  <th class="center">ส่วนลด</th>
                  <th class="center" colspan="2">จำนวนเงิน (บาท)</th>
               </tr>
            </thead>
            <tbody id="tb_products">
               <tr class="hidden" id="tb_products_0">
                  <td><label class="g-input"><input type="text" name="quantity[]" size="2" value="1" class="num" id="quantity_0"></label></td>
                  <td><label class="g-input"><input type="text" name="topic[]" value="" id="topic_0"></label></td>
                  <td><label class="g-input"><input type="text" name="price[]" size="5" value="0" class="price" id="price_0"></label></td>
                  <td class="center"><label>ภาษีมูลค่าเพิ่ม <input type="checkbox" name="vat[]" value="0" class="vat" id="vat_0"></label></td>
                  <td class="wlabel"><label class="g-input"><input type="text" name="discount[]" value="0" size="5" class="price" id="discount_0"></label><span class="label">%</span></td>
                  <td><label class="g-input"><input type="text" name="total[]" size="5" readonly="" id="total_0"></label></td>
                  <td><a class="button wide delete notext" tabindex="0" style="cursor: pointer;"><span class="icon-delete"></span></a><input type="hidden" name="id[]" value="0" id="id_0"></td>
               </tr>
            </tbody>
            <tfoot>
               <tr>
                  <td colspan="3" rowspan="8" class="top"><label for="comment">หมายเหตุ</label><span class="g-input icon-file"><textarea rows="6" name="comment" id="comment"></textarea></span></td>
                  <td class="right">รวม</td>
                  <td colspan="2" class="right" id="sub_total">0.00</td>
                  <td class="right">บาท</td>
               </tr>
               <tr>
                  <td class="right"><label for="discount_percent">ส่วนลด<span class="tablet"> (F8)</span></label></td>
                  <td class="wlabel"><span class="g-input"><input name="discount_percent" id="discount_percent" type="text" title="ส่วนลด %" size="5" class="currency ginput" data-keyboard="1234567890-."></span><span class="label">%</span></td>
                  <td><span class="g-input"><input name="total_discount" id="total_discount" type="text" title="ส่วนลด" size="5" class="currency ginput" data-keyboard="1234567890-."></span></td>
                  <td class="right">บาท</td>
               </tr>
               <tr>
                  <td class="right">ราคารวมก่อนภาษี</td>
                  <td></td>
                  <td><label class="g-input"><input type="text" class="result" id="amount" name="amount" size="5" readonly=""></label></td>
                  <td class="right">บาท</td>
               </tr>
               <tr>
                  <td class="right"><label for="vat_status">ภาษีมูลค่าเพิ่ม</label></td>
                  <td>
                     <span class="g-input">
                        <select name="vat_status" id="vat_status">
                           <option value="0" selected="">ไม่มีภาษี</option>
                           <option value="1">แยกภาษี</option>
                           <option value="2">รวมภาษี</option>
                        </select>
                     </span>
                  </td>
                  <td><label class="g-input"><input type="text" class="result" id="vat_total" name="vat_total" size="5" value="0.00" readonly=""></label></td>
                  <td class="right">บาท</td>
               </tr>
               <tr>
                  <td class="right">รวมราคาทั้งสิ้น</td>
                  <td colspan="2" class="right" id="grand_total">0.00</td>
                  <td class="right">บาท</td>
               </tr>
               <tr>
                  <td class="right"><label for="tax_status">ภาษีหัก ณ. ที่จ่าย</label></td>
                  <td>
                     <span class="g-input">
                        <select name="tax_status" id="tax_status">
                           <option value="0" selected="">ไม่มีภาษี</option>
                           <option value="0.75">0.75%</option>
                           <option value="1">1.0%</option>
                           <option value="2">2.0%</option>
                           <option value="3">3.0%</option>
                           <option value="5">5.0%</option>
                           <option value="10">10.0%</option>
                        </select>
                     </span>
                  </td>
                  <td><label class="g-input"><input type="text" class="result" id="tax_total" name="tax_total" size="5" value="0.00" readonly=""></label></td>
                  <td class="right">บาท</td>
               </tr>
               <tr class="due">
                  <td class="right">ยอดชำระ</td>
                  <td colspan="2" class="total right" id="payment_amount">0.00</td>
                  <td class="right">บาท</td>
               </tr>
               <tr>
                  <td class="right"><label for="status">สถานะ<span class="tablet"> (F9)</span></label></td>
                  <td colspan="3">
                     <span class="g-input icon-star0">
                        <select id="status" name="status">
                           <option value="1">ใบเสนอราคา</option>
                           <option value="6" selected="">ใบเสร็จ</option>
                        </select>
                     </span>
                  </td>
               </tr>
            </tfoot>
         </table>
      </div>
   </fieldset>
   <fieldset class="submit right"><label><input id="save_and_create" type="checkbox" name="save_and_create" value="1" title="บันทึกแล้วสร้างใหม่&nbsp;">บันทึกแล้วสร้างใหม่&nbsp;</label><button class="button ok large" id="order_submit" type="submit" name="order_submit">บันทึก<span class="tablet"> (F10)</span></button><input id="order_id" type="hidden" name="order_id" value="0"><input id="customer_id" type="hidden" name="customer_id" value="0"></fieldset>
</form>
