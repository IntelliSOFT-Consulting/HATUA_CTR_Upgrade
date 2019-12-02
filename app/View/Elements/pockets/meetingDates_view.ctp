
<div class="meetingDate-form">    
    <table class="table  table-condensed">
      <tbody>
        <tr>
          <td>First date: <h5> <?php echo $meetingDate['MeetingDate']['proposed_date1']; ?> </h5> </td>
          <td>Second date: <h5> <?php echo $meetingDate['MeetingDate']['proposed_date2']; ?> </h5> </td>
        </tr>
      </tbody>
    </table>
    <hr>
    <h4 style="text-decoration: underline;"> BACKGROUND INFORMATION </h4>

    <table class="table  table-condensed">
      <tbody>
        <tr>
          <td class="table-label required"><p>Email  <span class="sterix">*</span></p></td>
          <td><?php  echo $meetingDate['MeetingDate']['email']; ?></td>
          <td class="table-label required"><p>Address</p></td>
          <td><?php  echo $meetingDate['MeetingDate']['address']; ?></td>
        </tr>
      </tbody>
    </table>

    <table class="table  table-condensed">
      <tbody>
        <tr>
          <td class="table-label required" width="25%"><p>Background information on the disease to be treated <span class="sterix">*</span></p></td>
          <td><?php  echo $meetingDate['MeetingDate']['disease_background']; ?></td>
        </tr>
        <tr>
          <td class="table-label required" width="25%"><p>Background information on the product  <span class="sterix">*</span></p></td>
          <td><?php  echo $meetingDate['MeetingDate']['product_background']; ?></td>
        </tr>
        <tr>
          <td class="table-label required" width="25%"><p>Quality development <span class="sterix">*</span></p></td>
          <td><?php  echo $meetingDate['MeetingDate']['quality_development']; ?></td>
        </tr>
        <tr>
          <td class="table-label required" width="25%"><p>Non-clinical development <span class="sterix">*</span></p></td>
          <td><?php  echo $meetingDate['MeetingDate']['non_clinical_development']; ?></td>
        </tr>
        <tr>
          <td class="table-label required" width="25%"><p>Regulatory status <span class="sterix">*</span></p></td>
          <td><?php  echo $meetingDate['MeetingDate']['regulatory_status']; ?></td>
        </tr>
        <tr>
          <td class="table-label required" width="25%"><p>Rationale for seeking advice <span class="sterix">*</span></p></td>
          <td><?php  echo $meetingDate['MeetingDate']['advice_rationale']; ?></td>
        </tr>
        <tr>
          <td class="table-label required" width="25%"><p>Proposed Questions and Applicant's positions <span class="sterix">*</span></p></td>
          <td><?php  echo $meetingDate['MeetingDate']['proposed_questions']; ?></td>
        </tr>
      </tbody>
    </table>
    <hr class="my-view">


</div>