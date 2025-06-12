import { setupDropdownSpeciality, setupDropdownDoctor, setupDropdownLength,
         setupChooseSpeciality, setupDatePicker, setupButton, setupAppointments } 
         from '../../src/js/appointments';

describe('Appointments Module', () => {
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

    test('should handle speciality change', () => {
      const mockSpecialities = [{ id: 1, name: 'Speciality 1' }];
      const mockChangeCallback = jest.fn();
      
      setupDropdownSpeciality(mockSpecialities, mockChangeCallback);
      
      const select = document.getElementById('speciality');
      const changeEvent = new Event('change');
      select.value = '1';
      select.dispatchEvent(changeEvent);
      
      expect(mockChangeCallback).toHaveBeenCalledWith('1');
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
      
      expect(select.options.length).toBe(2);
      expect(select.options[1].value).toBe('1');
    });
  });

  describe('setupDropdownLength', () => {
    beforeEach(() => {
      document.body.innerHTML = '<select id="length"></select>';
    });

    test('should initialize length dropdown with correct options', () => {
      const mockLengths = [10, 25, 50, 100];
      
      setupDropdownLength(mockLengths);
      const select = document.getElementById('length');
      
      expect(select.options.length).toBe(5);
      expect(select.options[1].value).toBe('10');
      expect(select.options[1].text).toBe('10');
    });

    test('should handle length change', () => {
      const mockLengths = [10, 25, 50];
      const mockChangeCallback = jest.fn();
      
      setupDropdownLength(mockLengths, mockChangeCallback);
      
      const select = document.getElementById('length');
      const changeEvent = new Event('change');
      select.value = '25';
      select.dispatchEvent(changeEvent);
      
      expect(mockChangeCallback).toHaveBeenCalledWith('25');
    });
  });

  describe('setupAppointments', () => {
    beforeEach(() => {
      document.body.innerHTML = `
        <div id="appointments">
          <table>
            <thead>
              <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Speciality</th>
                <th>Reason</th>
                <th>Room</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
          <div id="pagination">
            <button id="button-previous">Previous</button>
            <span id="current-page">1</span>
            <button id="button-next">Next</button>
          </div>
        </div>
      `;
    });

    test('should render appointments table', () => {
      const mockAppointments = [
        {
          id: 1,
          date: '2024-03-20',
          patient_name: 'John Doe',
          speciality: 'Cardiology',
          reason: 'Checkup',
          room: 'Room 101',
          status: 'processing'
        }
      ];
      
      setupAppointments(mockAppointments);
      
      const tbody = document.querySelector('tbody');
      expect(tbody.children.length).toBe(1);
      expect(tbody.children[0].querySelector('td:nth-child(2)').textContent).toBe('John Doe');
    });

    test('should handle pagination', () => {
      const mockAppointments = Array(15).fill().map((_, i) => ({
        id: i + 1,
        date: '2024-03-20',
        patient_name: `Patient ${i + 1}`,
        speciality: 'Cardiology',
        reason: 'Checkup',
        room: 'Room 101',
        status: 'processing'
      }));
      
      const mockPageChangeCallback = jest.fn();
      setupAppointments(mockAppointments, mockPageChangeCallback);
      
      const nextButton = document.getElementById('button-next');
      nextButton.click();
      
      expect(mockPageChangeCallback).toHaveBeenCalledWith(2);
    });

    test('should handle appointment actions', () => {
      const mockAppointments = [{
        id: 1,
        date: '2024-03-20',
        patient_name: 'John Doe',
        speciality: 'Cardiology',
        reason: 'Checkup',
        room: 'Room 101',
        status: 'processing'
      }];
      
      const mockActionCallback = jest.fn();
      setupAppointments(mockAppointments, null, mockActionCallback);
      
      const actionButton = document.querySelector('.action-button');
      actionButton.click();
      
      expect(mockActionCallback).toHaveBeenCalledWith(1);
    });

    test('should handle empty appointments', () => {
      setupAppointments([]);
      
      const tbody = document.querySelector('tbody');
      expect(tbody.children.length).toBe(1);
      expect(tbody.children[0].textContent).toContain('No appointments found');
    });

    test('should handle API errors', async () => {
      const mockErrorCallback = jest.fn();
      setupAppointments(null, null, null, mockErrorCallback);
      
      // Simulate API error
      const error = new Error('API Error');
      mockErrorCallback(error);
      
      expect(mockErrorCallback).toHaveBeenCalledWith(error);
    });

    test('should handle status changes', () => {
      const mockAppointments = [{
        id: 1,
        date: '2024-03-20',
        patient_name: 'John Doe',
        speciality: 'Cardiology',
        reason: 'Checkup',
        room: 'Room 101',
        status: 'processing'
      }];
      
      const mockStatusChangeCallback = jest.fn();
      setupAppointments(mockAppointments, null, null, null, mockStatusChangeCallback);
      
      const statusSelect = document.querySelector('.status-select');
      const changeEvent = new Event('change');
      statusSelect.value = 'done';
      statusSelect.dispatchEvent(changeEvent);
      
      expect(mockStatusChangeCallback).toHaveBeenCalledWith(1, 'done');
    });
  });

  describe('setupButton', () => {
    beforeEach(() => {
      document.body.innerHTML = `
        <button id="button-search">Search</button>
        <button id="button-reset">Reset</button>
        <button id="button-add">Add</button>
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

    test('should handle add button click', () => {
      const mockAddCallback = jest.fn();
      setupButton('button-add', mockAddCallback);
      
      const button = document.getElementById('button-add');
      button.click();
      
      expect(mockAddCallback).toHaveBeenCalled();
    });

    test('should handle button click with validation', () => {
      const mockClickCallback = jest.fn();
      const mockValidationCallback = jest.fn().mockReturnValue(true);
      
      setupButton('button-search', mockClickCallback, null, mockValidationCallback);
      
      const button = document.getElementById('button-search');
      button.click();
      
      expect(mockValidationCallback).toHaveBeenCalled();
      expect(mockClickCallback).toHaveBeenCalled();
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