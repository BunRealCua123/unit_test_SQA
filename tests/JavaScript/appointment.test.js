import { setupDropdownService, setupDropdownSpeciality, setupDropdownDoctor, 
         setupChooseSpeciality, setupDatePicker, setupDatePickerForPatientBirthday,
         setupTimePicker, setupAppointmentInfo, setupButton, setupPatientInformation } 
         from '../../src/js/appointment';

describe('Appointment Module', () => {
  describe('setupDropdownService', () => {
    beforeEach(() => {
      document.body.innerHTML = '<select id="service"></select>';
    });

    test('should initialize service dropdown with correct options', () => {
      const mockServices = [
        { id: 1, name: 'Service 1' },
        { id: 2, name: 'Service 2' }
      ];
      
      setupDropdownService(mockServices);
      const select = document.getElementById('service');
      
      expect(select.options.length).toBe(3); // Including default option
      expect(select.options[1].value).toBe('1');
      expect(select.options[1].text).toBe('Service 1');
    });

    test('should handle empty services array', () => {
      setupDropdownService([]);
      const select = document.getElementById('service');
      expect(select.options.length).toBe(1); // Only default option
    });

    test('should handle null services', () => {
      setupDropdownService(null);
      const select = document.getElementById('service');
      expect(select.options.length).toBe(1);
    });
  });

  describe('setupDropdownSpeciality', () => {
    beforeEach(() => {
      document.body.innerHTML = '<select id="speciality"></select>';
    });

    test('should initialize speciality dropdown with correct options', () => {
      const mockSpecialities = [
        { id: 1, name: 'Speciality 1' },
        { id: 2, name: 'Speciality 2' }
      ];
      
      setupDropdownSpeciality(mockSpecialities);
      const select = document.getElementById('speciality');
      
      expect(select.options.length).toBe(3);
      expect(select.options[1].value).toBe('1');
      expect(select.options[1].text).toBe('Speciality 1');
    });

    test('should trigger change event when speciality is selected', () => {
      const mockSpecialities = [{ id: 1, name: 'Speciality 1' }];
      setupDropdownSpeciality(mockSpecialities);
      
      const select = document.getElementById('speciality');
      const changeEvent = new Event('change');
      select.value = '1';
      select.dispatchEvent(changeEvent);
      
      // Add assertions based on your implementation
    });
  });

  describe('setupDatePicker', () => {
    beforeEach(() => {
      document.body.innerHTML = '<input type="text" id="datepicker">';
    });

    test('should initialize datepicker with correct format', () => {
      setupDatePicker();
      const input = document.getElementById('datepicker');
      expect(input).toHaveAttribute('data-date-format', 'yyyy-mm-dd');
    });

    test('should handle date selection', () => {
      setupDatePicker();
      const input = document.getElementById('datepicker');
      const changeEvent = new Event('change');
      input.value = '2024-03-20';
      input.dispatchEvent(changeEvent);
      
      // Add assertions based on your implementation
    });
  });

  describe('setupTimePicker', () => {
    beforeEach(() => {
      document.body.innerHTML = '<input type="text" id="timepicker">';
    });

    test('should initialize timepicker with correct format', () => {
      setupTimePicker();
      const input = document.getElementById('timepicker');
      expect(input).toHaveAttribute('data-time-format', 'HH:mm');
    });

    test('should handle time selection', () => {
      setupTimePicker();
      const input = document.getElementById('timepicker');
      const changeEvent = new Event('change');
      input.value = '14:30';
      input.dispatchEvent(changeEvent);
      
      // Add assertions based on your implementation
    });
  });

  describe('setupAppointmentInfo', () => {
    beforeEach(() => {
      document.body.innerHTML = `
        <div id="appointment-info">
          <div id="patient-name"></div>
          <div id="patient-phone"></div>
          <div id="patient-birthday"></div>
          <div id="patient-reason"></div>
        </div>
      `;
    });

    test('should update appointment info with correct data', () => {
      const mockAppointment = {
        patient_name: 'John Doe',
        patient_phone: '1234567890',
        patient_birthday: '1990-01-01',
        patient_reason: 'Checkup'
      };

      setupAppointmentInfo(mockAppointment);

      expect(document.getElementById('patient-name').textContent).toBe('John Doe');
      expect(document.getElementById('patient-phone').textContent).toBe('1234567890');
      expect(document.getElementById('patient-birthday').textContent).toBe('1990-01-01');
      expect(document.getElementById('patient-reason').textContent).toBe('Checkup');
    });

    test('should handle missing data', () => {
      setupAppointmentInfo({});
      
      expect(document.getElementById('patient-name').textContent).toBe('');
      expect(document.getElementById('patient-phone').textContent).toBe('');
      expect(document.getElementById('patient-birthday').textContent).toBe('');
      expect(document.getElementById('patient-reason').textContent).toBe('');
    });
  });

  describe('setupButton', () => {
    beforeEach(() => {
      document.body.innerHTML = '<button id="test-button">Test</button>';
    });

    test('should handle button click', () => {
      const mockCallback = jest.fn();
      setupButton('test-button', mockCallback);
      
      const button = document.getElementById('test-button');
      button.click();
      
      expect(mockCallback).toHaveBeenCalled();
    });

    test('should handle button click with data', () => {
      const mockCallback = jest.fn();
      const mockData = { id: 1 };
      
      setupButton('test-button', mockCallback, mockData);
      
      const button = document.getElementById('test-button');
      button.click();
      
      expect(mockCallback).toHaveBeenCalledWith(mockData);
    });
  });

  describe('setupPatientInformation', () => {
    beforeEach(() => {
      document.body.innerHTML = `
        <form id="patient-form">
          <input type="text" id="patient-id">
          <input type="text" id="patient-name">
          <input type="text" id="patient-phone">
          <input type="text" id="patient-birthday">
          <textarea id="patient-reason"></textarea>
        </form>
      `;
    });

    test('should populate patient information form', () => {
      const mockPatient = {
        id: 'P001',
        name: 'John Doe',
        phone: '1234567890',
        birthday: '1990-01-01',
        reason: 'Checkup'
      };

      setupPatientInformation(mockPatient);

      expect(document.getElementById('patient-id').value).toBe('P001');
      expect(document.getElementById('patient-name').value).toBe('John Doe');
      expect(document.getElementById('patient-phone').value).toBe('1234567890');
      expect(document.getElementById('patient-birthday').value).toBe('1990-01-01');
      expect(document.getElementById('patient-reason').value).toBe('Checkup');
    });

    test('should handle form submission', () => {
      const mockSubmitHandler = jest.fn();
      setupPatientInformation({}, mockSubmitHandler);

      const form = document.getElementById('patient-form');
      const submitEvent = new Event('submit');
      form.dispatchEvent(submitEvent);

      expect(mockSubmitHandler).toHaveBeenCalled();
    });
  });
}); 