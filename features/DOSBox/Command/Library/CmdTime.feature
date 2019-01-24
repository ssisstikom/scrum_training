Feature: Get Time
  As a system time
  I want to know what OS time is

  Scenario: 
    When I typed TIME in any directory
    Then I should know what is current OS time

    When I typed TIME 21:30:10, command accepted, no output on console
    
    When I typed gaga, command rejected with error message displayed on console