
-- Update Job Seeker Information Procedure
CREATE PROCEDURE [dbo].[JBSK_UpdateInfo]
	@jobseekerID		INT,
	@firstName			VARCHAR(MAX),
	@middleName			VARCHAR(MAX),
	@lastName			VARCHAR(MAX),
	@birthDate			VARCHAR(MAX),
	@gender				VARCHAR(MAX),
	@street				VARCHAR(MAX),
	@brgyDistrict		VARCHAR(MAX),
	@cityMunicipality	VARCHAR(MAX),
	@contactNumber		VARCHAR(MAX),
	@description		VARCHAR(MAX),
	@skills				VARCHAR(MAX),
	@experiences		VARCHAR(MAX),
	@education			VARCHAR(MAX)
AS
	UPDATE [dbo].[JobSeekers]
	SET
		  [firstName] 		 = @firstName
		, [middleName] 		 = @middleName
		, [lastName] 		 = @lastName
		, [birthDate] 		 = @birthDate
		, [gender] 			 = @gender
		, [street] 			 = @street
		, [brgyDistrict] 	 = @brgyDistrict
		, [cityMunicipality] = @cityMunicipality
		, [contactNumber] 	 = @contactNumber
		, [description]		 = @description
		, [skills] 			 = @skills
		, [experiences] 	 = @experiences
		, [education] 		 = @education
	WHERE [jobseekerID] = @jobseekerID
;


-- Submit Application Procedure
CREATE PROCEDURE [dbo].[JBSK_SubmitApplication]
	@jobPostID	 INT,
	@jobseekerID INT
AS
	INSERT INTO [dbo].[Applications]
		( [jobPostID]
		, [jobseekerID] )
	VALUES (
		@jobPostID,
		@jobseekerID
	)
;


-- Cancel Application Procedure
CREATE PROCEDURE [dbo].[JBSK_CancelApplication]
	@jobPostID	 INT,
	@jobseekerID INT
AS
	DELETE FROM [Applications]
	WHERE [jobPostID] = @jobPostID AND @jobseekerID = @jobseekerID
;


-- Is Job Applied Procedure
CREATE PROCEDURE [dbo].[JBSK_IsJobApplied]
	@jobPostID		INT,
	@jobseekerID	INT
AS
	SELECT [status] FROM [Applications]
	WHERE [jobPostID] = @jobPostID
	AND [jobseekerID] = @jobseekerID
;


-- All Applied Jobs Procedure
CREATE PROCEDURE [dbo].[JBSK_AllAppliedJobs]
	@jobseekerID INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[industryType]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [Employers].[employerID]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityMunicipality] AS [location]
		, [Applications].[applicationID]
		, [Applications].[dateApplied]
		, [Applications].[status]
	FROM [JobPosts]
	INNER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
	AND [Applications].[jobseekerID] = @jobseekerID
	ORDER BY [Applications].[dateApplied] DESC
;


-- Applied Jobs Procedure
CREATE PROCEDURE [dbo].[JBSK_AppliedJobs]
	@offsetRows	 INT,
	@fetchedRows INT,
	@jobseekerID INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[industryType]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [Employers].[employerID]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityMunicipality] AS [location]
		, [Applications].[applicationID]
		, [Applications].[dateApplied]
		, [Applications].[status]
	FROM [JobPosts]
	INNER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
	AND [Applications].[jobseekerID] = @jobseekerID
	ORDER BY [Applications].[dateApplied] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY
;

SELECT * FROM Applications
