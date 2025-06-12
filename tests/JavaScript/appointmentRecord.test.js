import { setupDropdownStatus, setupDropdownStatusBefore, setupDropdownStatusAfter,
         setupButton, setupAppointmentRecord } 
         from '../../src/js/appointmentRecord';

describe('AppointmentRecord Module', () => {
  describe('setupDropdownStatus', () => {
    beforeEach(() => {
      document.body.innerHTML = '<select id="status"></select>';
    });

    test('should initialize status dropdown with correct options', () => {
      const mockStatuses = [
        { id: 'processing', name: 'Processing' },
        { id: 'cancelled', name: 'Cancelled' },
        { id: 'done', name: 'Done' }
      ];
      
      setupDropdownStatus(mockStatuses);
      const select = document.getElementById('status');
      
      expect(select.options.length).toBe(4); // Including default option
      expect(select.options[1].value).toBe('processing');
      expect(select.options[1].text).toBe('Processing');
    });

    test('should handle status change', () => {
      const mockStatuses = [{ id: 'processing', name: 'Processing' }];
      const mockChangeCallback = jest.fn();
      
      setupDropdownStatus(mockStatuses, mockChangeCallback);
      
      const select = document.getElementById('status');
      const changeEvent = new Event('change');
      select.value = 'processing';
      select.dispatchEvent(changeEvent);
      
      expect(mockChangeCallback).toHaveBeenCalledWith('processing');
    });
  });

  describe('setupDropdownStatusBefore', () => {
    beforeEach(() => {
      document.body.innerHTML = '<select id="status-before"></select>';
    });

    test('should initialize status-before dropdown with correct options', () => {
      const mockStatuses = [
        { id: 'processing', name: 'Processing' },
        { id: 'cancelled', name: 'Cancelled' }
      ];
      
      setupDropdownStatusBefore(mockStatuses);
      const select = document.getElementById('status-before');
      
      expect(select.options.length).toBe(3);
      expect(select.options[1].value).toBe('processing');
      expect(select.options[1].text).toBe('Processing');
    });

    test('should handle status-before change', () => {
      const mockStatuses = [{ id: 'processing', name: 'Processing' }];
      const mockChangeCallback = jest.fn();
      
      setupDropdownStatusBefore(mockStatuses, mockChangeCallback);
      
      const select = document.getElementById('status-before');
      const changeEvent = new Event('change');
      select.value = 'processing';
      select.dispatchEvent(changeEvent);
      
      expect(mockChangeCallback).toHaveBeenCalledWith('processing');
    });
  });

  describe('setupDropdownStatusAfter', () => {
    beforeEach(() => {
      document.body.innerHTML = '<select id="status-after"></select>';
    });

    test('should initialize status-after dropdown with correct options', () => {
      const mockStatuses = [
        { id: 'processing', name: 'Processing' },
        { id: 'done', name: 'Done' }
      ];
      
      setupDropdownStatusAfter(mockStatuses);
      const select = document.getElementById('status-after');
      
      expect(select.options.length).toBe(3);
      expect(select.options[1].value).toBe('processing');
      expect(select.options[1].text).toBe('Processing');
    });

    test('should handle status-after change', () => {
      const mockStatuses = [{ id: 'processing', name: 'Processing' }];
      const mockChangeCallback = jest.fn();
      
      setupDropdownStatusAfter(mockStatuses, mockChangeCallback);
      
      const select = document.getElementById('status-after');
      const changeEvent = new Event('change');
      select.value = 'processing';
      select.dispatchEvent(changeEvent);
      
      expect(mockChangeCallback).toHaveBeenCalledWith('processing');
    });
  });

  describe('setupAppointmentRecord', () => {
    beforeEach(() => {
      document.body.innerHTML = `
        <form id="record-form">
          <select id="status-before"></select>
          <select id="status-after"></select>
          <textarea id="reason"></textarea>
          <textarea id="description"></textarea>
          <button type="submit" id="button-save">Save</button>
        </form>
      `;
    });

    test('should handle form submission with valid data', () => {
      const mockSubmitCallback = jest.fn();
      setupAppointmentRecord(mockSubmitCallback);
      
      const form = document.getElementById('record-form');
      const submitEvent = new Event('submit');
      
      // Set form values
      document.getElementById('status-before').value = 'processing';
      document.getElementById('status-after').value = 'done';
      document.getElementById('reason').value = 'Patient recovered';
      document.getElementById('description').value = 'Treatment completed successfully';
      
      form.dispatchEvent(submitEvent);
      
      expect(mockSubmitCallback).toHaveBeenCalledWith({
        status_before: 'processing',
        status_after: 'done',
        reason: 'Patient recovered',
        description: 'Treatment completed successfully'
      });
    });

    test('should validate required fields', () => {
      const mockSubmitCallback = jest.fn();
      setupAppointmentRecord(mockSubmitCallback);
      
      const form = document.getElementById('record-form');
      const submitEvent = new Event('submit');
      
      // Don't set any values
      form.dispatchEvent(submitEvent);
      
      expect(mockSubmitCallback).not.toHaveBeenCalled();
      // Add assertions for validation messages
    });

    test('should handle API errors', async () => {
      const mockSubmitCallback = jest.fn().mockRejectedValue(new Error('API Error'));
      const mockErrorCallback = jest.fn();
      
      setupAppointmentRecord(mockSubmitCallback, mockErrorCallback);
      
      const form = document.getElementById('record-form');
      const submitEvent = new Event('submit');
      
      // Set form values
      document.getElementById('status-before').value = 'processing';
      document.getElementById('status-after').value = 'done';
      
      await form.dispatchEvent(submitEvent);
      
      expect(mockErrorCallback).toHaveBeenCalled();
    });
  });

  describe('setupButton', () => {
    beforeEach(() => {
      document.body.innerHTML = '<button id="button-save">Save</button>';
    });

    test('should handle button click', () => {
      const mockClickCallback = jest.fn();
      setupButton('button-save', mockClickCallback);
      
      const button = document.getElementById('button-save');
      button.click();
      
      expect(mockClickCallback).toHaveBeenCalled();
    });

    test('should handle button click with data', () => {
      const mockClickCallback = jest.fn();
      const mockData = { id: 1 };
      
      setupButton('button-save', mockClickCallback, mockData);
      
      const button = document.getElementById('button-save');
      button.click();
      
      expect(mockClickCallback).toHaveBeenCalledWith(mockData);
    });

    test('should handle button click with validation', () => {
      const mockClickCallback = jest.fn();
      const mockValidationCallback = jest.fn().mockReturnValue(true);
      
      setupButton('button-save', mockClickCallback, null, mockValidationCallback);
      
      const button = document.getElementById('button-save');
      button.click();
      
      expect(mockValidationCallback).toHaveBeenCalled();
      expect(mockClickCallback).toHaveBeenCalled();
    });

    test('should not trigger callback if validation fails', () => {
      const mockClickCallback = jest.fn();
      const mockValidationCallback = jest.fn().mockReturnValue(false);
      
      setupButton('button-save', mockClickCallback, null, mockValidationCallback);
      
      const button = document.getElementById('button-save');
      button.click();
      
      expect(mockValidationCallback).toHaveBeenCalled();
      expect(mockClickCallback).not.toHaveBeenCalled();
    });
  });
}); 