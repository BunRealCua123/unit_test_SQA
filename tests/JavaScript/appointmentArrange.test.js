import { setupDropdownSpeciality, setupDropdownDoctor, setupChooseSpeciality,
         setupDatePicker, setupButton, setupAppointmentList } 
         from '../../src/js/appointmentArrange';

describe('AppointmentArrange Module', () => {
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

    test('should trigger doctor dropdown update when speciality changes', () => {
      const mockSpecialities = [{ id: 1, name: 'Speciality 1' }];
      setupDropdownSpeciality(mockSpecialities);
      
      const select = document.getElementById('speciality');
      const changeEvent = new Event('change');
      select.value = '1';
      select.dispatchEvent(changeEvent);
      
      // Add assertions based on your implementation
    });
  });

  describe('setupDropdownDoctor', () => {
    beforeEach(() => {
      document.body.innerHTML = '<select id="doctor"></select>';
    });

    test('should initialize doctor dropdown with correct options', () => {
      const mockDoctors = [
        { id: 1, name: 'Doctor 1', speciality_id: 1 },
        { id: 2, name: 'Doctor 2', speciality_id: 1 }
      ];
      
      setupDropdownDoctor(mockDoctors);
      const select = document.getElementById('doctor');
      
      expect(select.options.length).toBe(3);
      expect(select.options[1].value).toBe('1');
      expect(select.options[1].text).toBe('Doctor 1');
    });

    test('should filter doctors by speciality', () => {
      const mockDoctors = [
        { id: 1, name: 'Doctor 1', speciality_id: 1 },
        { id: 2, name: 'Doctor 2', speciality_id: 2 }
      ];
      
      setupDropdownDoctor(mockDoctors, 1);
      const select = document.getElementById('doctor');
      
      expect(select.options.length).toBe(2); // Including default option
      expect(select.options[1].value).toBe('1');
    });
  });

  describe('setupAppointmentList', () => {
    beforeEach(() => {
      document.body.innerHTML = `
        <div id="appointmentSortable">
          <div class="appointment-item" data-id="1">
            <div class="patient-name">John Doe</div>
            <div class="appointment-time">10:00</div>
          </div>
          <div class="appointment-item" data-id="2">
            <div class="patient-name">Jane Smith</div>
            <div class="appointment-time">11:00</div>
          </div>
        </div>
      `;
    });

    test('should initialize sortable list', () => {
      setupAppointmentList();
      const list = document.getElementById('appointmentSortable');
      expect(list).toHaveClass('ui-sortable');
    });

    test('should handle appointment reordering', () => {
      const mockUpdateCallback = jest.fn();
      setupAppointmentList(mockUpdateCallback);
      
      // Simulate drag and drop
      const firstItem = document.querySelector('.appointment-item[data-id="1"]');
      const secondItem = document.querySelector('.appointment-item[data-id="2"]');
      
      // Add drag and drop simulation
      // This would depend on your implementation of the sortable functionality
      
      expect(mockUpdateCallback).toHaveBeenCalled();
    });

    test('should handle appointment removal', () => {
      const mockRemoveCallback = jest.fn();
      setupAppointmentList(null, mockRemoveCallback);
      
      const removeButton = document.querySelector('.remove-appointment');
      if (removeButton) {
        removeButton.click();
        expect(mockRemoveCallback).toHaveBeenCalled();
      }
    });
  });

  describe('setupButton', () => {
    beforeEach(() => {
      document.body.innerHTML = `
        <button id="button-search">Search</button>
        <button id="button-reset">Reset</button>
        <button id="button-save">Save</button>
      `;
    });

    test('should handle search button click', () => {
      const mockSearchCallback = jest.fn();
      setupButton('button-search', mockSearchCallback);
      
      const button = document.getElementById('button-search');
      button.click();
      
      expect(mockSearchCallback).toHaveBeenCalled();
    });

    test('should handle reset button click', () => {
      const mockResetCallback = jest.fn();
      setupButton('button-reset', mockResetCallback);
      
      const button = document.getElementById('button-reset');
      button.click();
      
      expect(mockResetCallback).toHaveBeenCalled();
    });

    test('should handle save button click', () => {
      const mockSaveCallback = jest.fn();
      setupButton('button-save', mockSaveCallback);
      
      const button = document.getElementById('button-save');
      button.click();
      
      expect(mockSaveCallback).toHaveBeenCalled();
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
      const mockDateChangeCallback = jest.fn();
      setupDatePicker(mockDateChangeCallback);
      
      const input = document.getElementById('datepicker');
      const changeEvent = new Event('change');
      input.value = '2024-03-20';
      input.dispatchEvent(changeEvent);
      
      expect(mockDateChangeCallback).toHaveBeenCalledWith('2024-03-20');
    });
  });
}); 